@extends('admin.layout')

@section('content')
<h2 class="text-2xl font-bold mb-4">Tentang Kami</h2>
{{-- Notifikasi sukses hanya di layout utama --}}
<form method="POST" action="{{ route('admin.about.update') }}" class="max-w-2xl bg-white p-6 rounded shadow">
	@csrf
	<div class="mb-4">
		<label class="block font-semibold mb-1">Tentang Kami</label>
		<textarea name="about_content" class="w-full border p-2" rows="15" required>{{ old('about_content', $about->content ?? '') }}</textarea>
		@error('about_content') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
	</div>
	<div class="mb-4">
		<label class="block font-semibold mb-1">Kontak Kami</label>
		<textarea name="contact_content" class="w-full border p-2" rows="6" required>{{ old('contact_content', $contact->content ?? '') }}</textarea>
		@error('contact_content') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
	</div>
	<button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
</form>
@endsection
