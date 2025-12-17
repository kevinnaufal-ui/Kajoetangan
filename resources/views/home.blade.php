@extends('layout')
@section('title', 'Beranda | Kajoetangan')
@section('head')
<style>
    /* Hero Section */
    .hero-section {
        display: flex;
        gap: 32px;
        align-items: flex-start;
        margin-bottom: 48px;
    }
    .hero-left {
        flex-shrink: 0;
        max-width: 320px;
    }
    .hero-title {
        color: #5a2600;
        font-size: 2.5rem;
        font-weight: 900;
        margin: 0 0 16px 0;
        line-height: 1.15;
    }
    .hero-desc {
        color: #5a2600;
        font-size: 0.95rem;
        line-height: 1.6;
    }
    .hero-right {
        flex: 1;
        position: relative;
    }
    .hero-image {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border-radius: 16px;
        box-shadow: 0 8px 32px rgba(90, 38, 0, 0.15);
    }

    /* Section Title */
    .section-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 1.5rem;
        font-style: italic;
        margin: 0 0 20px 0;
    }

    /* Sejarah Section */
    .sejarah-section {
        margin-bottom: 48px;
    }
    .sejarah-content {
        display: flex;
        gap: 24px;
        align-items: flex-start;
    }
    .sejarah-image {
        width: 280px;
        height: 200px;
        object-fit: cover;
        border-radius: 16px;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(90, 38, 0, 0.12);
    }
    .sejarah-info {
        flex: 1;
    }
    .sejarah-text {
        color: #5a2600;
        font-size: 0.95rem;
        line-height: 1.7;
        margin: 0 0 20px 0;
    }
    .btn-selengkapnya {
        display: inline-block;
        padding: 12px 28px;
        background: linear-gradient(135deg, #a04a1a, #8b3d15);
        color: #fff;
        border-radius: 24px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(160, 74, 26, 0.3);
    }
    .btn-selengkapnya:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(160, 74, 26, 0.4);
    }

    /* Galeri Section */
    .galeri-section {
        margin-bottom: 48px;
    }
    .galeri-grid {
        display: flex;
        gap: 20px;
    }
    .galeri-item {
        flex: 1;
        height: 280px;
        border-radius: 16px;
        object-fit: cover;
        box-shadow: 0 4px 16px rgba(90, 38, 0, 0.12);
        transition: transform 0.3s ease;
    }
    .galeri-item:hover {
        transform: scale(1.02);
    }

    /* Maps Section */
    .maps-section {
        margin-bottom: 48px;
    }
    .maps-content {
        display: flex;
        gap: 32px;
        align-items: flex-start;
    }
    .maps-embed {
        width: 320px;
        height: 240px;
        border: none;
        border-radius: 16px;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(90, 38, 0, 0.12);
    }
    .maps-info {
        flex: 1;
    }
    .maps-info h3 {
        color: #5a2600;
        font-weight: 900;
        font-size: 1.2rem;
        margin: 0 0 12px 0;
    }
    .maps-info p {
        color: #5a2600;
        font-size: 0.9rem;
        margin: 0 0 16px 0;
        line-height: 1.5;
    }
    .maps-location {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 10px;
        color: #5a2600;
        font-size: 0.85rem;
        line-height: 1.4;
    }
    .maps-location .icon {
        color: #a04a1a;
        flex-shrink: 0;
    }
    .maps-jam {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        color: #5a2600;
        font-size: 0.85rem;
    }
    .maps-jam .icon {
        color: #a04a1a;
    }
    .btn-google-maps {
        display: inline-block;
        padding: 10px 24px;
        background: linear-gradient(135deg, #a04a1a, #8b3d15);
        color: #fff;
        border-radius: 20px;
        text-decoration: none;
        font-weight: 700;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    .btn-google-maps:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(160, 74, 26, 0.3);
    }

    /* Artikel Section */
    .artikel-section {
        margin-bottom: 32px;
    }
    .artikel-grid {
        display: flex;
        gap: 16px;
    }
    .artikel-card {
        flex: 1;
        background: linear-gradient(135deg, #a04a1a, #8b3d15);
        border-radius: 16px;
        overflow: hidden;
        text-decoration: none;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 16px rgba(90, 38, 0, 0.2);
    }
    .artikel-card:hover {
        transform: translateY(-4px);
    }
    .artikel-card img {
        width: 100%;
        height: 90px;
        object-fit: cover;
    }
    .artikel-card .card-content {
        padding: 12px;
        color: #fff;
        font-size: 0.8rem;
        font-weight: 600;
        line-height: 1.4;
        min-height: 60px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-section {
            flex-direction: column;
        }
        .hero-left {
            max-width: 100%;
        }
        .sejarah-content {
            flex-direction: column;
        }
        .sejarah-image {
            width: 100%;
            height: 180px;
        }
        .galeri-grid {
            flex-direction: column;
        }
        .galeri-item {
            height: 200px;
        }
        .maps-content {
            flex-direction: column;
        }
        .maps-embed {
            width: 100%;
            height: 200px;
        }
        .artikel-grid {
            flex-direction: column;
        }
        .hero-title {
            font-size: 1.5rem;
        }
    }
</style>
@endsection
@section('content')
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="hero-left">
            <h1 class="hero-title">KAMPOENG HERITAGE KAJOETANGAN</h1>
            <p class="hero-desc">Wisata bersejarah yang populer di Malang dengan bangunan-bangunan peninggalan masa kolonial.</p>
        </div>
        <div class="hero-right">
            <img src="/images/beranda.jpg" alt="Kampoeng Heritage Kajoetangan" class="hero-image">
        </div>
    </div>

    <!-- Sejarah Section -->
    <div class="sejarah-section">
        <h2 class="section-title">SEJARAH</h2>
        <div class="sejarah-content">
            <img src="/images/sejarah.jpg" alt="Sejarah Kajoetangan" class="sejarah-image">
            <div class="sejarah-info">
                <p class="sejarah-text">Sejarah yang berisikan tentang asal-usul Kampoeng Kajoetangan, zaman saat para kolonial menghuni kampung, hingga masa kejayaannya sampai sekarang.</p>
                <a href="/sejarah" class="btn-selengkapnya">Selengkapnya...</a>
            </div>
        </div>
    </div>

    <!-- Galeri Section -->
    <div class="galeri-section">
        <h2 class="section-title">GALERI FOTO</h2>
        <div class="galeri-grid">
            <img src="/images/galeri1.jpg" alt="Galeri 1" class="galeri-item">
            <img src="/images/galeri2.jpg" alt="Galeri 2" class="galeri-item">
            <img src="/images/galeri3.jpg" alt="Galeri 3" class="galeri-item">
        </div>
    </div>

    <!-- Maps Section -->
    <div class="maps-section">
        <h2 class="section-title">MAPS</h2>
        <div class="maps-content">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.003073964624!2d112.626944!3d-7.977222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd629e2e2e2e2e2%3A0x2e2e2e2e2e2e2e2e!2sKampoeng%20Heritage%20Kajoetangan!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                class="maps-embed"
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="maps-info">
                <h3>KAJOETANGAN</h3>
                <p>Kampoeng Heritage Kajoetangan berada pada lokasi :</p>
                <div class="maps-location">
                    <span class="icon">📍</span>
                    <span>Jl. Raya Gempol - Malang, Kauman, Kec. Klojen, Kota Malang, Jawa Timur 65119</span>
                </div>
                <div class="maps-jam">
                    <span class="icon">🕐</span>
                    <span>Jam Operasional : 07.00 - 20.00</span>
                </div>
                <a href="https://goo.gl/maps/kajoetangan" target="_blank" class="btn-google-maps">Google Maps</a>
            </div>
        </div>
    </div>

    <!-- Artikel Section -->
    <div class="artikel-section">
        <h2 class="section-title">ARTIKEL</h2>
        <div class="artikel-grid">
            <a href="#" class="artikel-card">
                <img src="/images/artikel1.jpg" alt="Artikel 1">
                <div class="card-content">Pesona Kayutangan Heritage Tarik Minat Wisatawan</div>
            </a>
            <a href="#" class="artikel-card">
                <img src="/images/artikel2.jpg" alt="Artikel 2">
                <div class="card-content">10 Pesona Kampoeng Heritage Kajoetangan Malang</div>
            </a>
            <a href="#" class="artikel-card">
                <img src="/images/artikel3.jpg" alt="Artikel 3">
                <div class="card-content">Ngopi uenak Arek Malang di Kayutangan Heritage: Belajar Budaya dan Sejarah Sambil Ngopi</div>
            </a>
            <a href="#" class="artikel-card">
                <img src="/images/artikel4.jpg" alt="Artikel 4">
                <div class="card-content">Desa Wisata Kampoeng Heritage Kajoetangan</div>
            </a>
        </div>
    </div>
@endsection
