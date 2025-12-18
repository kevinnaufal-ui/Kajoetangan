@extends('admin.layout')

@section('content')
<h2 class="text-2xl font-bold mb-4">Buat Acara</h2>
<form method="POST" action="{{ route('admin.events.store') }}" class="bg-white p-4 rounded shadow" enctype="multipart/form-data">
    @csrf
    @if($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-2 rounded mb-3">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="mb-3">
        <label class="block font-medium mb-1">Judul Acara</label>
        <input name="title" class="w-full border p-2 rounded" value="{{ old('title') }}" required>
    </div>
    <div class="mb-3">
        <label class="block font-medium mb-1">Tanggal & Waktu</label>
        <input type="datetime-local" name="event_date" class="w-full border p-2 rounded" value="{{ old('event_date') }}" required>
    </div>
    <div class="mb-3">
        <label class="block font-medium mb-1">Lokasi</label>
        <input name="location" class="w-full border p-2 rounded" value="{{ old('location') }}" placeholder="Contoh: Kafe Hamur Mbah Ndut 1923">
    </div>
    <div class="mb-3">
        <label class="block font-medium mb-1">Alamat</label>
        <input name="address" class="w-full border p-2 rounded" value="{{ old('address') }}" placeholder="Contoh: Jl. Basuki Rahmat Gg. VI No.4, Kauman">
    </div>
    <div class="mb-3">
        <label class="block font-medium mb-1">Embed Google Maps (opsional)</label>
        <textarea name="map_embed_url" class="w-full border p-2 rounded" rows="2" placeholder="Paste kode iframe lengkap dari Google Maps di sini">{{ old('map_embed_url') }}</textarea>
        <p class="text-sm text-gray-500 mt-1">Buka Google Maps → Share → Embed → Copy HTML. Tempelkan seluruh kodenya di sini.</p>
    </div>
    <div class="mb-3">
        <label class="block font-medium mb-1">Deskripsi</label>
        <textarea name="description" class="w-full border p-2 rounded" rows="4">{{ old('description') }}</textarea>
    </div>
    <div class="mb-3">
        <label class="block font-medium mb-1">Poster / Gambar (opsional)</label>
        <input type="file" name="image" accept="image/*" class="w-full border p-2 rounded" />
        @error('image') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
    </div>
    <button class="bg-green-600 text-white px-4 py-2 rounded">Simpan Acara</button>
</form>
@endsection
