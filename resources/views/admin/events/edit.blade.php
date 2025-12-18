@extends('admin.layout')

@section('content')
<h2 class="text-2xl font-bold mb-4">Edit Acara</h2>
<form method="POST" action="{{ route('admin.events.update', $event) }}" class="bg-white p-4 rounded shadow" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @if($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-2 rounded mb-3">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="mb-3">
        <label class="block font-medium mb-1">Judul Acara</label>
        <input name="title" class="w-full border p-2 rounded" value="{{ old('title', $event->title) }}" required>
    </div>
    <div class="mb-3">
        <label class="block font-medium mb-1">Tanggal & Waktu</label>
        <input type="datetime-local" name="event_date" class="w-full border p-2 rounded" value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" required>
    </div>
    <div class="mb-3">
        <label class="block font-medium mb-1">Lokasi</label>
        <input name="location" class="w-full border p-2 rounded" value="{{ old('location', $event->location) }}" placeholder="Contoh: Kafe Hamur Mbah Ndut 1923">
    </div>
    <div class="mb-3">
        <label class="block font-medium mb-1">Alamat</label>
        <input name="address" class="w-full border p-2 rounded" value="{{ old('address', $event->address) }}" placeholder="Contoh: Jl. Basuki Rahmat Gg. VI No.4, Kauman">
    </div>
    <div class="mb-3">
        <label class="block font-medium mb-1">Embed Google Maps (opsional)</label>
        <textarea name="map_embed_url" class="w-full border p-2 rounded" rows="2" placeholder="Paste kode iframe lengkap dari Google Maps di sini">{{ old('map_embed_url', $event->map_embed_url) }}</textarea>
        <p class="text-sm text-gray-500 mt-1">Buka Google Maps → Share → Embed → Copy HTML. Tempelkan seluruh kodenya di sini.</p>
    </div>
    <div class="mb-3">
        <label class="block font-medium mb-1">Deskripsi</label>
        <textarea name="description" class="w-full border p-2 rounded" rows="4">{{ old('description', $event->description) }}</textarea>
    </div>
    <div class="mb-3">
        <label class="block font-medium mb-1">Poster / Gambar</label>
        @if($event->image_url)
            <div class="mb-2">
                <img src="{{ $event->image_url }}" alt="Current poster" class="w-32 h-auto rounded">
                <p class="text-sm text-gray-500 mt-1">Gambar saat ini. Upload baru untuk mengganti.</p>
            </div>
        @endif
        <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded" />
        @error('image') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="flex gap-3">
        <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
        <a href="{{ route('admin.events.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</a>
    </div>
</form>
@endsection
