@extends('admin.layout')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-bold">Acara</h2>
    <a href="{{ route('admin.events.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded">Buat Acara</a>
</div>
<ul class="mt-4 bg-white p-4">
    @foreach($events as $e)
        <li class="border-b py-4 flex items-center gap-4 relative">
            @if($e->image_url)
                <img src="{{ asset($e->image_url) }}" alt="poster" class="w-28 h-20 object-cover rounded">
            @endif
            <div>
                <div class="text-sm text-gray-600">{{ $e->date ?? $e->event_date }}</div>
                <div class="font-medium">{{ $e->title }}</div>
                @if($e->description)
                    <div class="text-sm text-gray-500">{{ Str::limit($e->description, 120) }}</div>
                @endif
            </div>
            <div class="absolute right-2 top-2 flex gap-2">
                <a href="{{ route('admin.events.edit', $e) }}" class="bg-blue-600 text-white px-2 py-1 rounded text-xs">Edit</a>
                <form method="POST" action="{{ route('admin.events.destroy', $e) }}" onsubmit="return confirm('Hapus acara ini?');">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-2 py-1 rounded text-xs">Hapus</button>
                </form>
            </div>
        </li>
    @endforeach
</ul>
@endsection
