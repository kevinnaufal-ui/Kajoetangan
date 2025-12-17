@extends('layout')
@section('title', 'Galeri | Kajoetangan')
@section('content')
    <h1 style="color:#5a2600;font-weight:900;">GALERI FOTO KAMPOENG HERITAGE KAJOETANGAN</h1>
    <div style="margin:24px 0;display:flex;gap:12px;">
        <a href="{{ route('galeri.upload') }}" style="background:#5a2600;color:#fff;padding:10px 24px;border-radius:18px;text-decoration:none;font-weight:700;">Unggah Gambar</a>
        <form method="GET" action="/galeri" style="display:inline;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari Gambar" style="padding:10px 18px;border-radius:18px;border:1px solid #ccc;min-width:220px;">
        </form>
    </div>
    <div style="display:flex;flex-wrap:wrap;gap:18px;">
        @forelse($galeri as $foto)
        <a href="{{ route('galeri.detail', $foto->id) }}" style="position:relative;width:260px;height:180px;overflow:hidden;border-radius:18px;background:#eee;display:block;text-decoration:none;">
            <img src="{{ $foto->image_url }}" style="width:100%;height:100%;object-fit:cover;">
            <div style="position:absolute;bottom:12px;right:12px;background:#fff;border:none;border-radius:50%;width:36px;height:36px;box-shadow:0 2px 8px #0002;display:flex;align-items:center;justify-content:center;">
                <span style="color:#a04a1a;font-size:22px;">&#9825; {{ $foto->total_likes }}</span>
            </div>
        </a>
        @empty
        <div style="color:#a04a1a;">Belum ada foto galeri.</div>
        @endforelse
    </div>
@endsection
