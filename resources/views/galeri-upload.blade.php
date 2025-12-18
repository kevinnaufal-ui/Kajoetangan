@extends('layout')
@section('title', 'Unggah Galeri | Kajoetangan')
@section('head')
<style>
    .upload-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 2.5rem;
        margin: 0 0 32px 0;
        line-height: 1.2;
    }
    .upload-container {
        background: linear-gradient(135deg, rgba(160, 74, 26, 0.1), rgba(160, 74, 26, 0.05));
        padding: 40px 32px;
        border-radius: 32px;
        box-shadow: 0 8px 32px rgba(90, 38, 0, 0.08);
    }
    .upload-form {
        display: flex;
        gap: 40px;
        align-items: stretch;
    }
    .upload-image-section {
        flex: 1;
        min-width: 0;
    }
    .upload-image-label {
        display: flex;
        width: 100%;
        height: 280px;
        background: #fff;
        border-radius: 24px;
        align-items: center;
        justify-content: center;
        font-size: 1.1em;
        color: #5a2600;
        cursor: pointer;
        overflow: hidden;
        border: 3px dashed #cfa98a;
        transition: all 0.3s ease;
    }
    .upload-image-label:hover {
        border-color: #a04a1a;
        background: #fef9f6;
    }
    .upload-image-label input[type="file"] {
        display: none;
    }
    .upload-image-label img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
    }
    .upload-form-section {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        font-weight: 700;
        color: #5a2600;
        margin-bottom: 8px;
        font-size: 1rem;
    }
    .form-input {
        width: 100%;
        padding: 14px 24px;
        border-radius: 24px;
        border: 2px solid #cfa98a;
        font-size: 1rem;
        color: #5a2600;
        box-sizing: border-box;
        transition: border-color 0.2s ease;
    }
    .form-input:focus {
        outline: none;
        border-color: #a04a1a;
    }
    .form-textarea {
        width: 100%;
        padding: 14px 24px;
        border-radius: 24px;
        border: 2px solid #cfa98a;
        min-height: 100px;
        font-size: 1rem;
        color: #5a2600;
        resize: vertical;
        box-sizing: border-box;
        font-family: inherit;
        transition: border-color 0.2s ease;
    }
    .form-textarea:focus {
        outline: none;
        border-color: #a04a1a;
    }
    .upload-btn {
        margin-top: auto;
        padding: 14px 48px;
        background: linear-gradient(135deg, #a04a1a, #5a2600);
        color: #fff;
        border: none;
        border-radius: 24px;
        font-size: 1.1em;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(160, 74, 26, 0.3);
        align-self: flex-end;
    }
    .upload-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(160, 74, 26, 0.4);
    }
    .upload-notice {
        margin-top: 24px;
        font-size: 0.9em;
        color: #5a2600;
        background: rgba(207, 169, 138, 0.3);
        padding: 12px 20px;
        border-radius: 16px;
        border-left: 4px solid #a04a1a;
    }
    @media (max-width: 768px) {
        .upload-form {
            flex-direction: column;
            gap: 24px;
        }
        .upload-image-label {
            height: 220px;
        }
        .upload-btn {
            width: 100%;
            align-self: stretch;
        }
        .upload-container {
            padding: 24px 20px;
        }
    }
</style>
@endsection
@section('content')
<h1 class="upload-title">GALERI FOTO KAMPOENG HERITAGE KAJOETANGAN</h1>
<div class="upload-container">
    <form method="POST" action="{{ route('galeri.store') }}" enctype="multipart/form-data" class="upload-form">
        @csrf
        <div class="upload-image-section">
            <label class="upload-image-label">
                <input type="file" name="image" id="imageInput" accept="image/*" required onchange="previewImage(event)">
                <img id="previewImg" src="" style="display:none;" alt="Preview">
                <span id="placeholderText">📷 Tambahkan Foto</span>
            </label>
        </div>
        <div class="upload-form-section">
            <div class="form-group">
                <label class="form-label">Judul Foto</label>
                <input type="text" name="title" required class="form-input" placeholder="Masukkan judul foto...">
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="caption" required class="form-textarea" placeholder="Tuliskan deskripsi foto..."></textarea>
            </div>
            <div style="display: flex; gap: 16px; margin-top: auto; padding-top: 32px; align-self: flex-end; width: 100%; justify-content: space-between;">
                <a href="{{ route('galeri') }}" class="upload-btn" style="text-decoration: none; text-align: center;">Kembali</a>
                <button type="submit" class="upload-btn">Unggah</button>
            </div>
        </div>
    </form>
    <div class="upload-notice">
        <strong>*Perhatian:</strong> Pengunggahan foto akan diberi jeda untuk pengelolaan dari pihak Kampoeng Heritage Kajoetangan, demi menghindari spam.
    </div>
</div>
<script>
function previewImage(event) {
    const input = event.target;
    const preview = document.getElementById('previewImg');
    const placeholder = document.getElementById('placeholderText');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            placeholder.style.display = 'none';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.style.display = 'none';
        placeholder.style.display = 'block';
    }
}
</script>
@endsection
