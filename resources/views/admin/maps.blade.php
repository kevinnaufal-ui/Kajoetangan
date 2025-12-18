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
		<label class="block font-semibold mb-1">1. Link Sematkan / Embed (Untuk Tampilan Peta)</label>
		{{-- Use textarea to allow full iframe code --}}
		<textarea name="maps_content" class="w-full border p-2 rounded" rows="3" required placeholder="Paste kode iframe lengkap di sini">{{ old('maps_content', $maps->content ?? '') }}</textarea>
		@error('maps_content') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
		<div class="text-xs text-gray-500 mt-1">Tempelkan kode <code>&lt;iframe...</code> dari Google Maps (Bagikan -> Sematkan Peta).</div>
	</div>

	<div class="mb-4">
		<label class="block font-semibold mb-1">2. Link Tombol Google Maps (Untuk Redirect)</label>
		<input type="url" name="maps_link" class="w-full border p-2 rounded" value="{{ old('maps_link', $mapsLink->content ?? '') }}" required placeholder="https://maps.app.goo.gl/...">
		@error('maps_link') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
		<div class="text-xs text-gray-500 mt-1">Link ini akan dibuka ketika pengunjung mengklik tombol "Google Maps". Gunakan link pendek (Share Link) agar rapi.</div>
	</div>

	<div class="my-4 bg-blue-50 border border-blue-200 text-blue-800 p-3 rounded text-sm">
		<strong>Petunjuk Baru:</strong>
		<ul class="list-disc pl-4 mt-1 space-y-1">
			<li><strong>Kolom 1:</strong> Khusus untuk tampilan kotak peta di website. Gunakan fitur "Sematkan Peta" di Google Maps.</li>
			<li><strong>Kolom 2:</strong> Khusus untuk tombol. Gunakan fitur "Salin Link" biasa di Google Maps agar saat diklik langsung membuka aplikasi Maps.</li>
		</ul>
	</div>
	<button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan Link</button>
</form>
@endsection
