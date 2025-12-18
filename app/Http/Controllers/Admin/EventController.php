<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date','desc')->paginate(20);
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
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'map_embed_url' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);
        $imageUrl = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events','public');
            $imageUrl = '/storage/'.$path;
        }

        // Clean iframe if detected
        if (isset($data['map_embed_url']) && str_contains($data['map_embed_url'], '<iframe') && preg_match('/src="([^"]+)"/', $data['map_embed_url'], $matches)) {
            $data['map_embed_url'] = $matches[1];
        }

        Event::create([
            'title' => $data['title'],
            'event_date' => $data['event_date'],
            'location' => $data['location'] ?? null,
            'address' => $data['address'] ?? null,
            'map_embed_url' => $data['map_embed_url'] ?? null,
            'description' => $data['description'] ?? null,
            'image_url' => $imageUrl
        ]);
        return redirect()->route('admin.events.index')->with('status','Acara berhasil ditambahkan');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return back()->with('status','Acara berhasil dihapus');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'title' => 'required|string|max:200',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'map_embed_url' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Clean iframe if detected
        if (isset($data['map_embed_url']) && str_contains($data['map_embed_url'], '<iframe') && preg_match('/src="([^"]+)"/', $data['map_embed_url'], $matches)) {
            $data['map_embed_url'] = $matches[1];
        }

        $event->title = $data['title'];
        $event->event_date = $data['event_date'];
        $event->location = $data['location'] ?? null;
        $event->address = $data['address'] ?? null;
        $event->map_embed_url = $data['map_embed_url'] ?? null;
        $event->description = $data['description'] ?? null;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('events','public');
            $event->image_url = '/storage/'.$path;
        }

        $event->save();
        return redirect()->route('admin.events.index')->with('status','Acara berhasil diperbarui');
    }
}
