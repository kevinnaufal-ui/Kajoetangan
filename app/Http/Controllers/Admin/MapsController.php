<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;

class MapsController extends Controller
{
    public function show()
    {
        $maps = AboutPage::firstOrCreate(['section'=>'maps'], ['content'=>'https://www.google.com/maps']);
        $mapsLink = AboutPage::firstOrCreate(['section'=>'maps_link'], ['content'=>'https://www.google.com/maps']);
        return view('admin.maps', compact('maps', 'mapsLink'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'maps_content' => 'required', // Iframe
            'maps_link' => 'required|url', // Button Link
        ]);

        $input = $data['maps_content'];
        $cleanUrl = $input;

        // Extract src from iframe
        if (str_contains($input, '<iframe') && preg_match('/src="([^"]+)"/', $input, $matches)) {
            $cleanUrl = $matches[1];
        }

        // Save Iframe Link
        $maps = AboutPage::where('section','maps')->first();
        $maps->content = $cleanUrl;
        $maps->save();

        // Save Button Link
        $mapsLink = AboutPage::firstOrCreate(['section'=>'maps_link']);
        $mapsLink->content = $data['maps_link'];
        $mapsLink->save();

        return redirect()->route('admin.maps')->with('status','Link Maps berhasil diperbarui');
    }
}
