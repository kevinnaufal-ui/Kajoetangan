<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date','desc')->paginate(20);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events','public');
            $imageUrl = 'storage/'.$path;
        }
        Event::create(['title' => $data['title'], 'date' => $data['date'], 'description' => $data['description'] ?? null, 'image_url' => $imageUrl]);
        return redirect()->route('admin.events.index')->with('status','Acara berhasil ditambahkan');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('status','Acara berhasil dihapus');
    }
}
