@extends('admin.layout')

@section('content')
<h2 class="text-2xl font-bold mb-4">Buat Acara</h2>
<form method="POST" action="{{ route('admin.events.store') }}" class="bg-white p-4" enctype="multipart/form-data">
    @csrf
    @if($errors->any())
        <div class="bg-red-100 border border-red-300 text-red-700 p-2 rounded mb-3">
            {{ $errors->first() }}
        </div>
    @endif
    <div class="mb-2"><label>Title</label><input name="title" class="w-full border p-2" value="{{ old('title') }}" required></div>
    <div class="mb-2"><label>Date</label><input type="date" name="date" class="w-full border p-2" value="{{ old('date') }}" required></div>
    <div class="mb-2"><label>Description</label><textarea name="description" class="w-full border p-2">{{ old('description') }}</textarea></div>
    <div class="mb-2">
        <label>Poster / Gambar (opsional)</label>
        <input type="file" name="image" accept="image/*" class="w-full border p-2" />
        @error('image') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
    </div>
    <button class="bg-green-600 text-white px-3 py-1 rounded">Simpan</button>
</form>
@endsection
