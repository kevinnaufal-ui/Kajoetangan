@extends('admin.layout')

@section('content')
<h2 class="text-xl font-bold mb-4">Galeri #{{ $gallery->id }}</h2>
<div class="bg-white p-4 rounded shadow">
    <div class="mb-3"><strong>Uploader:</strong> {{ $gallery->uploader_name ?? $gallery->uploader_email }}</div>
    <div class="mb-3"><img src="{{ asset($gallery->image_url) }}" alt="" class="max-w-full h-auto"></div>
    <div class="mb-3"><strong>Likes:</strong> {{ $gallery->total_likes }}</div>
    <div class="mb-3"><strong>Status:</strong> {{ $gallery->status }}</div>
    <form method="POST" action="{{ route('admin.galleries.approve',$gallery) }}">@csrf<button class="text-green-600">Approve</button></form>
    <form method="POST" action="{{ route('admin.galleries.reject',$gallery) }}">@csrf<input type="text" name="reason" placeholder="Reason" class="border p-2"><button class="text-red-600">Reject</button></form>
</div>
@endsection
