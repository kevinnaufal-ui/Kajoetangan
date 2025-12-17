@extends('admin.layout')

@section('content')
<h2 class="text-2xl font-bold mb-4">Maps</h2>
{{-- Notifikasi sukses hanya di layout utama --}}

@php
	$mapsUrl = old('maps_content', $maps->content ?? '');
	$embedUrl = '';
	if (Str::contains($mapsUrl, 'google.com/maps')) {
		// Try to convert to embeddable URL
		if (Str::contains($mapsUrl, '/embed')) {
			$embedUrl = $mapsUrl;
		} else {
			// Try to extract place or query
			$embedUrl = preg_replace('/\/maps\/place\/(.+)/', '/maps/embed?pb=$1', $mapsUrl);
			if (!Str::contains($embedUrl, 'embed')) {
				$embedUrl = '';
			}
		}
	}
@endphp

@if($embedUrl)
	<div class="mb-4">
		<iframe src="{{ $embedUrl }}" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	</div>
@endif

<form method="POST" action="{{ route('admin.maps.update') }}" class="max-w-2xl bg-white p-6 rounded shadow">
	@csrf
	<div class="mb-4">
		<label class="block font-semibold mb-1">Link Google Maps (wajib diisi)</label>
		<input type="url" name="maps_content" class="w-full border p-2" value="{{ old('maps_content', $maps->content ?? '') }}" required>
		@error('maps_content') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
		<div class="text-xs text-gray-500 mt-1">Contoh: https://www.google.com/maps/embed?pb=... atau link Google Maps lokasi</div>
	</div>
	<button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Link</button>
</form>
@endsection
