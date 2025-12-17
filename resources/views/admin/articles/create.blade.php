@extends('admin.layout')

@section('content')
<h2 class="text-xl font-bold mb-4">Tambah Artikel</h2>
<form method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" class="bg-white p-4">
    @csrf
    <div class="mb-3">
        <label class="block text-sm">Judul</label>
        <input type="text" name="title" class="w-full border p-2" required>
    </div>
    <div class="mb-3">
        <label class="block text-sm">Thumbnail (opsional)</label>
        <input type="file" name="thumbnail" accept="image/*" class="w-full border p-2">
        @error('thumbnail') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="block text-sm">Link Eksternal (contoh: https://news.example.com/...)</label>
        <input type="url" name="external_link" class="w-full border p-2" placeholder="https://">
    </div>
    <div class="mb-3">
        <label class="block text-sm">Kategori</label>
        <select name="category" class="w-full border p-2">
            <option value="artikel_umum">Artikel Umum</option>
            <option value="sejarah">Sejarah</option>
        </select>
    </div>
    <div class="flex gap-2">
        <button class="bg-green-600 text-white px-3 py-1 rounded">Simpan</button>
        <a href="{{ route('admin.articles.index') }}" class="px-3 py-1 rounded border">Batal</a>
    </div>
</form>

@endsection
