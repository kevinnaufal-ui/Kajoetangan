<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;
use App\Models\HistoryImage;
use Illuminate\Support\Str;

class HistoryController extends Controller
{
    public function uploadImages(Request $request)
    {
        $history = AboutPage::where('section','history')->first();
        $data = $request->validate([
            'history_images.*' => 'nullable|image|max:2048',
        ]);
        if ($request->hasFile('history_images')) {
            foreach ($request->file('history_images') as $img) {
                $path = $img->store('history','public');
                HistoryImage::create([
                    'about_page_id' => $history->id,
                    'image_path' => 'storage/'.$path,
                ]);
            }
        }
        return redirect()->route('admin.history')->with('status','Gambar berhasil diupload');
    }
    public function show()
    {
        $history = AboutPage::firstOrCreate(['section'=>'history'], ['content'=>'Isi sejarah organisasi.']);
        $images = $history->historyImages()->get();
        // Cek jika masih ada gambar lama di about_pages section history_image
        $oldImage = AboutPage::where('section','history_image')->first();
        if ($oldImage && $oldImage->content && !empty($oldImage->content)) {
            // Migrasi otomatis ke tabel history_images jika belum ada di sana
            if (!HistoryImage::where('image_path', $oldImage->content)->where('about_page_id', $history->id)->exists()) {
                $migrated = HistoryImage::create([
                    'about_page_id' => $history->id,
                    'image_path' => $oldImage->content,
                ]);
                $images = $history->historyImages()->get();
            }
        }
        return view('admin.history', compact('history','images'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'history_content' => 'required|string',
            'history_images.*' => 'nullable|image|max:2048',
        ]);
        $history = AboutPage::where('section','history')->first();
        $history->content = $data['history_content'];
        $history->save();
        // handle multiple image upload
        if ($request->hasFile('history_images')) {
            foreach ($request->file('history_images') as $img) {
                $path = $img->store('history','public');
                HistoryImage::create([
                    'about_page_id' => $history->id,
                    'image_path' => 'storage/'.$path,
                ]);
            }
        }
        return redirect()->route('admin.history')->with('status','Sejarah berhasil diperbarui');
    }

    public function deleteImage($id)
    {
        $image = HistoryImage::find($id);
        if ($image) {
            // Jika gambar ini adalah hasil migrasi dari about_pages lama, hapus juga dari about_pages
            $aboutImage = AboutPage::where('section','history_image')->where('content', $image->image_path)->first();
            if ($aboutImage) {
                $aboutImage->content = '';
                $aboutImage->save();
            }
            if (Str::startsWith($image->image_path, 'storage/')) {
                $old = public_path($image->image_path);
                if (file_exists($old)) @unlink($old);
            }
            $image->delete();
        }
        return redirect()->route('admin.history')->with('status','Gambar dihapus');
    }
}
