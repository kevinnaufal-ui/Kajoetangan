@extends('admin.layout')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-bold">Artikel</h2>
    <a href="{{ route('admin.articles.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded">Tambah Artikel</a>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($articles as $a)
    <div class="bg-white rounded-lg shadow overflow-hidden relative">
        <div class="h-40 bg-gray-100 flex items-center justify-center">
            @if($a->thumbnail_url)
                <img src="{{ asset($a->thumbnail_url) }}" alt="thumb" class="object-cover w-full h-40">
            @else
                <div class="text-gray-400">No image</div>
            @endif
        </div>
        <div class="p-4">
            <div class="font-semibold">{{ $a->title }}</div>
            <div class="text-xs text-gray-500">Kategori: {{ $a->category }}</div>
            @if($a->external_link)
                <a href="{{ $a->external_link }}" target="_blank" class="text-indigo-600 text-sm">Buka Link</a>
            @endif
        </div>
        <div class="absolute top-2 right-2 flex gap-2">
            <a href="{{ route('admin.articles.edit', $a) }}" class="text-sm px-2 py-1 bg-yellow-100 border rounded">Edit</a>
            <form method="POST" action="{{ route('admin.articles.destroy', $a) }}" onsubmit="return confirm('Hapus artikel ini?');">
                @csrf
                @method('DELETE')
                <button class="text-sm px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

@if($articles->count() == 0)
    <div class="text-gray-500 mt-6">Belum ada artikel. Tekan "Tambah Artikel" untuk menambah (maksimal 4).</div>
@endif

@endsection
