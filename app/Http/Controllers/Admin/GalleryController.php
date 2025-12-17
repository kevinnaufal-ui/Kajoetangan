<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GalleryPhoto;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\LengthAwarePaginator;

class GalleryController extends Controller
{
    public function index()
    {
        $pending = GalleryPhoto::where('status','pending')->orderBy('created_at','desc')->paginate(12, ['*'], 'pending_page');
        if (Schema::hasColumn('gallery_photos','deletion_requested')) {
            $deletionRequests = GalleryPhoto::where('deletion_requested', true)->orderBy('created_at','desc')->paginate(12, ['*'], 'deletion_page');
        } else {
            $deletionRequests = new LengthAwarePaginator([], 0, 12, 1, ['path' => request()->url(), 'pageName' => 'deletion_page']);
        }
        return view('admin.galleries.index', compact('pending','deletionRequests'));
    }

    public function show(GalleryPhoto $gallery)
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    public function approve(GalleryPhoto $gallery)
    {
        $gallery->status = 'approved';
        $gallery->rejection_reason = null;
        $gallery->save();
        return back()->with('status','Gallery approved');
    }

    public function reject(Request $request, GalleryPhoto $gallery)
    {
        $request->validate(['reason'=>'required|string']);
        $gallery->status = 'rejected';
        $gallery->rejection_reason = $request->input('reason');
        $gallery->save();
        return back()->with('status','Gallery rejected');
    }

    public function destroy(GalleryPhoto $gallery)
    {
        if ($gallery->image_url && str_starts_with($gallery->image_url, 'storage/')) {
            $filePath = public_path($gallery->image_url);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }
        $gallery->delete();
        return back()->with('status','Gallery deleted');
    }

    public function deletionRequests()
    {
        if (Schema::hasColumn('gallery_photos','deletion_requested')) {
            $deletionRequests = GalleryPhoto::where('deletion_requested', true)->orderBy('created_at','desc')->paginate(20);
        } else {
            $deletionRequests = new LengthAwarePaginator([], 0, 20, 1, ['path' => request()->url(), 'pageName' => 'deletion_page']);
        }
        return view('admin.galleries.deletion_requests', compact('deletionRequests'));
    }

    public function approveDeletion(Request $request, GalleryPhoto $gallery)
    {
        $request->validate(['reason'=>'required|string']);
        $gallery->deletion_requested = false;
        $gallery->deleted_by_admin = session('admin_id');
        $gallery->deletion_reason = $request->input('reason');
        // remove stored file if present
        if ($gallery->image_url && str_starts_with($gallery->image_url, 'storage/')) {
            $filePath = public_path($gallery->image_url);
            if (file_exists($filePath)) {
                @unlink($filePath);
            }
        }
        $gallery->save();
        $gallery->delete();
        return back()->with('status','Deletion approved and file removed');
    }

    public function denyDeletion(Request $request, GalleryPhoto $gallery)
    {
        // deny deletion request, clear request fields
        $gallery->deletion_requested = false;
        $gallery->deletion_request_reason = null;
        $gallery->save();
        return back()->with('status','Deletion request denied');
    }
}
