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
        return view('admin.maps', compact('maps'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'maps_content' => 'required|url',
        ]);
        $maps = AboutPage::where('section','maps')->first();
        $maps->content = $data['maps_content'];
        $maps->save();
        return redirect()->route('admin.maps')->with('status','Link Maps berhasil diperbarui');
    }
}
