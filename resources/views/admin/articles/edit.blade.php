@extends('admin.layout')

@section('content')
<h2 class="text-xl font-bold mb-4">Edit Artikel</h2>
<form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data" class="bg-white p-4">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label class="block text-sm">Judul</label>
        <input type="text" name="title" class="w-full border p-2" value="{{ old('title', $article->title) }}" required>
    </div>
    <div class="mb-3">
        <label class="block text-sm">Thumbnail saat ini</label>
        @if($article->thumbnail_url)
            <img src="{{ asset($article->thumbnail_url) }}" class="w-48 h-28 object-cover mb-2">
        @else
            <div class="text-gray-500 mb-2">Tidak ada thumbnail</div>
        @endif
        <label class="block text-sm">Ganti Thumbnail (opsional)</label>
        <input type="file" name="thumbnail" accept="image/*" class="w-full border p-2">
        @error('thumbnail') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="block text-sm">Link Eksternal</label>
        <input type="url" name="external_link" class="w-full border p-2" value="{{ old('external_link', $article->external_link) }}">
    </div>
    <div class="mb-3">
        <label class="block text-sm">Kategori</label>
        <select name="category" class="w-full border p-2">
            <option value="artikel_umum" {{ old('category',$article->category)=='artikel_umum' ? 'selected':'' }}>Artikel Umum</option>
            <option value="sejarah" {{ old('category',$article->category)=='sejarah' ? 'selected':'' }}>Sejarah</option>
        </select>
    </div>
    <div class="flex gap-2">
        <button class="bg-green-600 text-white px-3 py-1 rounded">Simpan</button>
        <a href="{{ route('admin.articles.index') }}" class="px-3 py-1 rounded border">Batal</a>
    </div>
</form>

@endsection
