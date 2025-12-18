@extends('layout')
@section('title', 'Galeri | Kajoetangan')
@section('head')
<style>
    .page-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 2.5rem;
        margin: 0 0 24px 0;
        line-height: 1.2;
    }
    .galeri-actions {
        display: flex;
        gap: 16px;
        align-items: center;
        margin-bottom: 32px;
        flex-wrap: wrap;
    }
    .btn-upload {
        background: linear-gradient(135deg, #5a2600, #3d1a00);
        color: #fff;
        padding: 14px 32px;
        border-radius: 24px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.05rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(90, 38, 0, 0.25);
    }
    .btn-upload:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(90, 38, 0, 0.35);
    }
    .search-form {
        display: flex;
        gap: 10px;
        align-items: center;
        flex: 1;
        min-width: 0; /* Prevent flex overflow */
    }
    .search-input {
        padding: 14px 24px;
        border-radius: 24px;
        border: 2px solid #cfa98a;
        font-size: 1.05rem;
        color: #5a2600;
        transition: border-color 0.2s ease;
        flex: 1; /* Take remaining space */
        min-width: 0; /* Allow shrinking */
    }
    .search-input:focus {
        outline: none;
        border-color: #a04a1a;
    }
    .search-input::placeholder {
        color: #a08070;
    }
    .btn-search, .btn-back {
        background: linear-gradient(135deg, #5a2600, #3d1a00);
        color: #fff;
        padding: 14px 24px;
        border-radius: 24px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.05rem;
        border: none;
        cursor: pointer;
        white-space: nowrap;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(90, 38, 0, 0.25);
    }
    .btn-back {
        background: #8b3d15;
    }
    .btn-search:hover, .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(90, 38, 0, 0.35);
    }
    .galeri-grid {
        column-count: 2;
        column-gap: 32px;
    }
    .galeri-card {
        position: relative;
        overflow: hidden;
        border-radius: 16px;
        background: #eee;
        text-decoration: none;
        box-shadow: 0 4px 16px rgba(90, 38, 0, 0.1);
        transition: transform 0.3s ease;
        break-inside: avoid;
        margin-bottom: 32px;
        display: inline-block;
        width: 100%;
        min-height: 280px;
    }
    .galeri-card:hover {
        transform: translateY(-4px);
    }
    .galeri-card img {
        width: 100%;
        height: auto;
        min-height: 280px;
        object-fit: cover;
        display: block;
    }
    @media (max-width: 768px) {
        .galeri-grid {
            column-count: 1;
        }
    }
    .galeri-likes {
        position: absolute;
        bottom: 12px;
        right: 12px;
        background: #fff;
        border-radius: 20px;
        padding: 6px 14px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.9rem;
        color: #a04a1a;
        font-weight: 600;
    }
    .galeri-likes .heart {
        font-size: 1.1rem;
    }
    .empty-message {
        color: #a04a1a;
        font-size: 1rem;
        padding: 40px;
        text-align: center;
        background: rgba(207, 169, 138, 0.2);
        border-radius: 16px;
        width: 100%;
    }
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }
        .galeri-actions {
            flex-direction: column;
            align-items: stretch;
        }
        .search-input {
            min-width: auto;
            width: 100%;
        }
        .galeri-grid {
            justify-content: center;
        }
        .galeri-card {
            width: 100%;
            max-width: 320px;
        }
    }
</style>
@endsection
@section('content')
    <h1 class="page-title">GALERI FOTO KAMPOENG HERITAGE KAJOETANGAN</h1>
    <div class="galeri-actions">
        <!-- Wraps buttons and search for better control -->
        <a href="{{ route('galeri.upload') }}" class="btn-upload">Unggah Gambar</a>
        
        <form method="GET" action="{{ route('galeri') }}" class="search-form">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari Gambar..." class="search-input">
            <button type="submit" class="btn-search">Cari</button>
            @if(request('q'))
                <a href="{{ route('galeri') }}" class="btn-back">Kembali</a>
            @endif
        </form>
    </div>
    <div class="galeri-grid">
        @forelse($galeri as $foto)
        <a href="{{ route('galeri.detail', $foto->id) }}" class="galeri-card">
            <img src="{{ $foto->image_url }}" alt="{{ $foto->title }}">
            <div class="galeri-likes">
                <span class="heart">♡</span>
                <span>{{ $foto->total_likes }}</span>
            </div>
        </a>
        @empty
        <div class="empty-message">Belum ada foto galeri.</div>
        @endforelse
    </div>
@endsection
