@extends('admin.layout')

@section('content')
<h2 class="text-2xl font-bold mb-4">Halaman Sejarah</h2>
{{-- Notifikasi sukses hanya di layout utama --}}

<form method="POST" action="{{ route('admin.history.update') }}" enctype="multipart/form-data" class="max-w-2xl bg-white p-6 rounded shadow mb-6">
	@csrf
	<div class="mb-4">
		<label class="block font-semibold mb-1">Isi Sejarah <span class="text-red-500">*</span></label>
		<textarea name="history_content" class="w-full border p-2" rows="4" required>{{ old('history_content', $history->content ?? '') }}</textarea>
		@error('history_content') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
	</div>
	<button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
</form>

<div class="max-w-2xl bg-white p-6 rounded shadow mb-6">
	<div class="mb-2 flex items-center justify-between">
		<div class="font-semibold">Galeri Foto Sejarah</div>
		<form method="POST" action="{{ route('admin.history.images.upload') }}" enctype="multipart/form-data" class="inline-block">
			@csrf
			<input type="file" name="history_images[]" accept="image/*" class="border p-2 mr-2" multiple required>
			<button class="bg-blue-600 text-white px-3 py-1 rounded">Upload</button>
		</form>
	</div>
	<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
		@foreach($images as $img)
			<div class="flex flex-col items-center bg-white p-2 rounded shadow">
				<img src="{{ asset($img->image_path) }}" class="w-full h-32 object-cover rounded border">
				<form method="POST" action="{{ route('admin.history.image.delete', $img->id) }}" onsubmit="return confirm('Hapus gambar ini?');" class="w-full flex justify-center mt-2">
					@csrf
					<button class="px-3 py-1 bg-red-600 text-white rounded text-xs">Hapus</button>
				</form>
			</div>
		@endforeach
	</div>
</div>
<div class="max-w-2xl flex flex-wrap gap-4 mb-6">
	@foreach($images as $img)
		<form method="POST" action="{{ route('admin.history.image.delete', $img->id) }}" onsubmit="return confirm('Hapus gambar ini?');" class="relative group">
			@csrf
			<img src="{{ asset($img->image_path) }}" class="w-40 h-28 object-cover rounded border">
			<button class="absolute top-1 right-1 px-2 py-1 bg-red-600 text-white rounded text-xs opacity-80 group-hover:opacity-100">Hapus</button>
		</form>
	@endforeach
</div>
@endsection
