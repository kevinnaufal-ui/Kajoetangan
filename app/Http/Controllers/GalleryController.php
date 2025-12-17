<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\GalleryPhoto;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = GalleryPhoto::where('status', 'approved');
        if ($request->q) {
            $query->where(function($q) use ($request) {
                $q->where('caption', 'like', '%'.$request->q.'%')
                  ->orWhere('title', 'like', '%'.$request->q.'%');
            });
        }
        $galeri = $query->orderByDesc('id')->get();
        return view('galeri', compact('galeri'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'title' => 'required',
            'caption' => 'required',
        ]);
        $path = $request->file('image')->store('gallery', 'public');
        $photo = GalleryPhoto::create([
            'uploader_name' => 'Anonim',
            'uploader_email' => '',
            'image_url' => '/storage/' . $path,
            'caption' => $request->caption,
            'status' => 'pending',
            'rejection_reason' => null,
            'total_likes' => 0,
        ]);
        return Redirect::to('/galeri')->with('success', 'Foto berhasil diunggah, menunggu persetujuan admin.');
    }

    public function show($id)
    {
        $photo = GalleryPhoto::findOrFail($id);
        return view('galeri-detail', compact('photo'));
    }

    public function requestDelete(Request $request, $id)
    {
        $request->validate(['reason' => 'required']);
        $photo = GalleryPhoto::findOrFail($id);
        $photo->deletion_requested = true;
        $photo->deletion_request_reason = $request->reason;
        $photo->save();
        return Redirect::to('/galeri')->with('success', 'Permintaan penghapusan foto telah dikirim, menunggu persetujuan admin.');
    }
}
