@extends('layout')
@section('title', 'Hapus Foto Galeri | Kajoetangan')
@section('head')
<style>
    .page-header {
        text-align: center;
        margin-bottom: 32px;
    }
    .page-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 2rem;
        font-style: italic;
        text-decoration: line-through;
        text-decoration-thickness: 3px;
        opacity: 0.6;
        margin: 0;
        line-height: 1.3;
    }
    .delete-wrapper {
        position: relative;
        max-width: 900px;
        margin: 0 auto;
    }
    .delete-container {
        background: linear-gradient(135deg, #a04a1a, #8b3d15);
        padding: 40px 48px;
        border-radius: 32px;
        box-shadow: 0 12px 40px rgba(90, 38, 0, 0.25);
        position: relative;
        z-index: 2;
    }
    .delete-title {
        color: #fff;
        font-weight: 900;
        font-size: 1.8rem;
        margin: 0 0 28px 0;
        font-style: italic;
        line-height: 1.3;
    }
    .delete-form-row {
        display: flex;
        gap: 24px;
        align-items: flex-start;
        margin-bottom: 20px;
    }
    .delete-label {
        color: #fff;
        font-weight: 700;
        font-size: 1.05rem;
        font-style: italic;
        flex-shrink: 0;
    }
    .delete-notice {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.9rem;
        font-style: italic;
        text-align: right;
        flex: 1;
    }
    .delete-textarea {
        width: 100%;
        padding: 20px 24px;
        border-radius: 24px;
        border: none;
        margin-bottom: 28px;
        min-height: 100px;
        font-size: 1rem;
        font-family: inherit;
        resize: vertical;
        box-sizing: border-box;
        background: #fff;
    }
    .delete-textarea:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
    }
    .delete-buttons {
        display: flex;
        gap: 32px;
        justify-content: space-between;
    }
    .btn-back {
        flex: 1;
        max-width: 200px;
        display: inline-block;
        padding: 14px 32px;
        background: linear-gradient(135deg, #cfa98a, #b8926f);
        color: #5a2600;
        border: none;
        border-radius: 24px;
        font-size: 1.05em;
        font-weight: 700;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
    }
    .btn-delete {
        flex: 1;
        max-width: 200px;
        padding: 14px 32px;
        background: #fff;
        color: #a04a1a;
        border: none;
        border-radius: 24px;
        font-size: 1.05em;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        background: #f8f8f8;
    }
    .photo-preview {
        margin-top: -60px;
        padding-top: 80px;
        display: flex;
        gap: 24px;
        justify-content: flex-start;
        position: relative;
        z-index: 1;
    }
    .photo-preview img {
        width: 280px;
        height: 200px;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(90, 38, 0, 0.15);
    }
    @media (max-width: 768px) {
        .delete-container {
            padding: 28px 24px;
            margin: 0 16px;
        }
        .delete-title {
            font-size: 1.4rem;
        }
        .delete-form-row {
            flex-direction: column;
            gap: 8px;
        }
        .delete-notice {
            text-align: left;
        }
        .delete-buttons {
            flex-direction: column;
            gap: 16px;
        }
        .btn-back, .btn-delete {
            max-width: 100%;
        }
        .page-title {
            font-size: 1.5rem;
        }
        .photo-preview {
            flex-direction: column;
            align-items: center;
        }
        .photo-preview img {
            width: 100%;
            max-width: 280px;
        }
    }
</style>
@endsection
@section('content')
<div class="page-header">
    <h1 class="page-title">GALERI FOTO KAMPOENG<br>HERITAGE KAJOETANGAN</h1>
</div>
<div class="delete-wrapper">
    <div class="delete-container">
        <form method="POST" action="{{ route('galeri.requestDelete', $id) }}">
            @csrf
            <h2 class="delete-title">KENAPA INGIN<br>MENGHAPUS FOTO INI?</h2>
            <div class="delete-form-row">
                <label class="delete-label">Sertakan alasan yang jelas</label>
                <span class="delete-notice">*Penghapusan ini memerlukan persetujuan admin</span>
            </div>
            <textarea name="reason" required class="delete-textarea" placeholder="Tuliskan alasan penghapusan..."></textarea>
            <div class="delete-buttons">
                <a href="{{ url()->previous() }}" class="btn-back">Kembali</a>
                <button type="submit" class="btn-delete">Hapus</button>
            </div>
        </form>
    </div>
    @if(isset($photo) && $photo->image_url)
    <div class="photo-preview">
        <img src="{{ $photo->image_url }}" alt="Foto yang akan dihapus">
    </div>
    @endif
</div>
@endsection
