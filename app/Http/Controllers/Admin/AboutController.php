<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;

class AboutController extends Controller
{
    public function show()
    {
        $about = AboutPage::firstOrCreate(['section'=>'about'], ['content'=>'Deskripsi singkat tentang organisasi.']);
        $contact = AboutPage::firstOrCreate(['section'=>'contact'], ['content'=>'Kontak: email@contoh.com, 0812xxxxxxx']);
        return view('admin.about', compact('about','contact'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'about_content' => 'required|string',
            'contact_content' => 'required|string',
        ]);
        $about = AboutPage::where('section','about')->first();
        $contact = AboutPage::where('section','contact')->first();
        $about->content = $data['about_content'];
        $contact->content = $data['contact_content'];
        $about->save();
        $contact->save();
        return redirect()->route('admin.about')->with('status','Konten berhasil diperbarui');
    }
}
