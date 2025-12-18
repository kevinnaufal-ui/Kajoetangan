@extends('layout')
@section('title', 'Detail Foto Galeri | Kajoetangan')
@section('head')
<style>
    .page-header {
        margin-bottom: 32px;
    }
    .page-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 2.5rem;
        margin: 0;
        line-height: 1.2;
    }
    .detail-wrapper {
        display: flex;
        gap: 48px;
        align-items: flex-start;
    }
    .detail-image-section {
        flex: 1;
        max-width: 50%;
    }
    .detail-image {
        width: 100%;
        height: auto;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(90, 38, 0, 0.12);
        display: block;
    }
    .detail-info-section {
        flex: 1;
        min-width: 0;
    }
    .form-label {
        display: block;
        color: #5a2600;
        font-weight: 700;
        font-size: 1.2rem;
        font-style: italic;
        margin-bottom: 14px;
    }
    .form-input {
        width: 100%;
        padding: 18px 24px;
        border-radius: 24px;
        border: none;
        background: #fff;
        font-size: 1.1rem;
        color: #333;
        box-sizing: border-box;
        margin-bottom: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }
    .form-textarea {
        width: 100%;
        padding: 18px 24px;
        border-radius: 24px;
        border: none;
        background: #fff;
        min-height: 150px;
        font-size: 1.1rem;
        color: #333;
        resize: vertical;
        box-sizing: border-box;
        font-family: inherit;
        margin-bottom: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }
    .detail-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
    }
    .likes-display {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .like-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        background: #fff;
        border: 2px solid #cfa98a;
        border-radius: 24px;
        font-size: 1rem;
        color: #5a2600;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .like-btn:hover {
        background: #fbeee7;
        border-color: #a04a1a;
    }
    .like-btn.liked {
        background: #a04a1a;
        border-color: #a04a1a;
        color: #fff;
    }
    .like-btn .heart {
        font-size: 1.2rem;
    }
    .delete-btn {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 12px;
        width: 48px;
        height: 48px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }
    .delete-btn:hover {
        background: #f5f5f5;
        border-color: #a04a1a;
    }
    .delete-btn span {
        font-size: 1.4em;
        color: #666;
    }
    .delete-btn:hover span {
        color: #a04a1a;
    }
    .back-btn-wrapper {
        display: flex;
        justify-content: flex-end;
    }
    .back-btn {
        display: inline-block;
        padding: 14px 48px;
        background: linear-gradient(135deg, #cfa98a, #b8926f);
        color: #5a2600;
        border: none;
        border-radius: 24px;
        font-size: 1.05em;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(160, 74, 26, 0.2);
    }
    .back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(160, 74, 26, 0.3);
    }
    @media (max-width: 900px) {
        .detail-wrapper {
            flex-direction: column;
        }
        .detail-image-section {
            width: 100%;
        }
        .detail-image {
            min-height: 300px;
            max-height: 400px;
        }
        .page-title {
            font-size: 1.5rem;
        }
    }
</style>
@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">GALERI FOTO KAMPOENG<br>HERITAGE KAJOETANGAN</h1>
</div>
<div class="detail-wrapper">
    <div class="detail-image-section">
        <img src="{{ $photo->image_url ?? '/images/galeri1.jpg' }}" alt="{{ $photo->title ?? 'Foto Galeri' }}" class="detail-image">
    </div>
    <div class="detail-info-section">
        <label class="form-label">Judul Foto</label>
        <input type="text" value="{{ $photo->title ?? '' }}" readonly class="form-input">
        
        <label class="form-label">Deskripsi</label>
        <textarea readonly class="form-textarea">{{ $photo->caption ?? '' }}</textarea>
        
        <div class="detail-actions">
            <div class="likes-display">
                <form method="POST" action="{{ route('galeri.like', $photo->id) }}" id="likeForm">
                    @csrf
                    <button type="submit" class="like-btn" id="likeBtn">
                        <span class="heart">&#9825;</span>
                        <span id="likeCount">{{ number_format($photo->total_likes ?? 0, 0, ',', '.') }} Suka</span>
                    </button>
                </form>
            </div>
            <form method="GET" action="{{ route('galeri.hapus', $photo->id) }}">
                <button type="submit" class="delete-btn" title="Hapus foto">
                    <span>&#128465;</span>
                </button>
            </form>
        </div>
        
        <div class="back-btn-wrapper">
            <a href="/galeri" class="back-btn">Kembali</a>
        </div>
    </div>
</div>
@endsection
