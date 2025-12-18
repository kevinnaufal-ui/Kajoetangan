@extends('admin.layout')

@section('content')
<div class="flex items-center justify-between mb-4">
    <h2 class="text-2xl font-bold">Galeri - Uploads Menunggu</h2>
    <div class="text-sm text-gray-500">Total: {{ $pending->total() }}</div>
 </div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
@foreach($pending as $g)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="h-48 bg-gray-100 flex items-center justify-center">
            @if($g->image_url ?? false)
                <img src="{{ asset($g->image_url) }}" alt="" class="object-cover w-full h-48">
            @else
                <div class="text-gray-400">No image</div>
            @endif
        </div>
        <div class="p-4">
            <div class="flex justify-between items-start">
                <div>
                    <div class="font-semibold">{{ $g->title ?? 'Untitled' }}</div>
                    <div class="text-xs text-gray-500">ID #{{ $g->id }} · {{ $g->status }}</div>
                </div>
                <div class="text-sm text-gray-600">❤ {{ $g->total_likes }}</div>
            </div>
            <div class="mt-3 flex items-center gap-3">
                <a href="{{ route('admin.galleries.show',$g) }}" class="text-indigo-600 text-sm">Lihat</a>
                <form method="POST" action="{{ route('admin.galleries.approve',$g) }}">@csrf<button class="text-green-600 text-sm">Approve</button></form>
                <form method="POST" action="{{ route('admin.galleries.reject',$g) }}">@csrf<input type="hidden" name="reason" value="Spam or inappropriate"><button class="text-red-600 text-sm">Reject</button></form>
            </div>
        </div>
    </div>
@endforeach
</div>

<div class="mt-8">
    <h3 class="text-xl font-semibold mb-3">Permintaan Hapus Foto</h3>
    @if($deletionRequests->count())
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($deletionRequests as $d)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="h-48 bg-gray-100 flex items-center justify-center">
                @if($d->image_url)
                    <img src="{{ asset($d->image_url) }}" alt="" class="object-cover w-full h-48">
                @endif
            </div>
            <div class="p-4">
                <div class="font-semibold">{{ $d->title ?? 'Untitled' }}</div>
                <div class="text-xs text-gray-500">Request reason: {{ $d->deletion_request_reason }}</div>
                <form method="POST" action="{{ route('admin.galleries.approve_deletion',$d) }}" class="mt-3">
                    @csrf
                    <input type="text" name="reason" placeholder="Alasan menghapus (akan dikirim ke uploader)" class="w-full border p-2 mb-2" required>
                    <div class="flex gap-2">
                        <button class="bg-red-600 text-white px-3 py-1 rounded">Setujui Hapus</button>
                </form>
                <form method="POST" action="{{ route('admin.galleries.deny_deletion',$d) }}" class="">
                    @csrf
                    <button class="bg-gray-200 px-3 py-1 rounded">Tolak</button>
                </form>
                    </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $deletionRequests->links() }}</div>
    @else
        <div class="text-gray-500">Tidak ada permintaan hapus.</div>
    @endif
 </div>

@endsection
