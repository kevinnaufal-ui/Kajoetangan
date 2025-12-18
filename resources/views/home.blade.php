@extends('layout')
@section('title', 'Beranda | Kajoetangan')
@section('head')
<style>
    /* Hero Section */
    .hero-section {
        display: flex;
        flex-direction: column;
        gap: 32px;
        margin-bottom: 64px;
    }
    .hero-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 32px;
        width: 100%;
    }
    .hero-title {
        color: #5a2600;
        font-size: 2.8rem;
        font-weight: 900;
        line-height: 1.1;
        margin: 0;
        flex: 1;
        text-transform: uppercase;
    }
    .hero-desc {
        color: #5a2600;
        font-size: 1.1rem;
        line-height: 1.6;
        margin: 0;
        flex: 0 0 400px;
        max-width: 400px;
        padding-top: 8px;
    }
    .hero-image {
        width: 100%;
        height: 360px;
        object-fit: cover;
        border-radius: 24px;
        box-shadow: 0 8px 32px rgba(90, 38, 0, 0.15);
    }

    /* Section Title */
    .section-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 2.8rem;
        font-style: normal; /* Removed italic to match Hero Title */
        margin: 0;
        line-height: 1.1;
        text-transform: uppercase;
        flex: 1;
    }

    /* Sejarah Section */
    .sejarah-section {
        margin-bottom: 64px;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    .sejarah-content {
        display: flex;
        gap: 32px;
        align-items: center; /* Center vertically specifically for side-by-side */
    }
    .sejarah-image {
        flex: 1; /* Take up available space, or set specific width */
        width: 100%; /* logic handled by flex */
        max-width: 50%; /* Ensure it doesn't take over */
        height: 320px;
        object-fit: cover;
        border-radius: 24px;
        box-shadow: 0 4px 16px rgba(90, 38, 0, 0.12);
    }
    .sejarah-info {
        flex: 1;
        text-align: left;
    }
    .sejarah-text {
        color: #5a2600;
        font-size: 1.1rem;
        line-height: 1.6;
        margin: 0 0 24px 0;
    }
    .btn-selengkapnya {
        display: inline-block;
        padding: 14px 32px; /* Increased padding */
        background: linear-gradient(135deg, #a04a1a, #8b3d15);
        color: #fff;
        border-radius: 30px; /* Increased rounding for modern look */
        text-decoration: none;
        font-weight: 700;
        font-size: 1rem; /* Increased font size */
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
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }
    .galeri-item {
        width: 100%;
        height: 280px;
        border-radius: 24px;
        object-fit: cover;
        box-shadow: 0 4px 16px rgba(90, 38, 0, 0.12);
        transition: transform 0.3s ease;
    }
    .galeri-item:hover {
        transform: scale(1.02);
    }

    /* Maps Section */
    .maps-section {
        margin-bottom: 64px;
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    .maps-content {
        display: flex;
        gap: 32px;
        align-items: center;
    }
    .maps-embed {
        flex: 1;
        width: 100%;
        max-width: 50%;
        height: 320px;
        border: none;
        border-radius: 24px;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(90, 38, 0, 0.12);
    }
    .maps-info {
        flex: 1;
        text-align: left;
    }
    .maps-info h3 {
        color: #4e342e; /* Softer dark brown */
        font-weight: 900;
        font-size: 2rem;
        margin: 0 0 16px 0;
        text-transform: uppercase;
    }
    .maps-info p {
        color: #4e342e; /* Softer dark brown */
        font-size: 1.1rem;
        margin: 0 0 24px 0;
        line-height: 1.6;
    }
    .maps-location {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 16px;
        color: #5a2600;
        font-size: 1rem;
        line-height: 1.5;
    }
    .maps-location .icon {
        color: #a04a1a;
        flex-shrink: 0;
        font-size: 1.2rem;
    }
    .maps-jam {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 24px;
        color: #5a2600;
        font-size: 1rem;
    }
    .maps-jam .icon {
        color: #a04a1a;
        font-size: 1.2rem;
    }
    .btn-google-maps {
        display: inline-block;
        margin-top: 16px; /* Added spacing */
        padding: 14px 32px;
        background: linear-gradient(135deg, #a04a1a, #8b3d15);
        color: #fff;
        border-radius: 30px; /* Increased rounding */
        text-decoration: none;
        font-weight: 700;
        font-size: 1rem; /* Increased font size */
        transition: all 0.3s ease;
    }
    .btn-google-maps:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(160, 74, 26, 0.3);
    }

    /* Artikel Section */
    .artikel-section {
        margin-bottom: 64px;
    }
    .artikel-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 32px;
    }
    .artikel-card {
        background-color: #bf5930; /* Terracotta/Orange */
        border-radius: 24px;
        overflow: hidden;
        display: flex;
        align-items: center;
        padding: 16px;
        gap: 16px;
        height: 200px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }
    .artikel-card:hover {
        transform: translateY(-5px);
    }
    .artikel-image {
        width: 180px;
        height: 100%;
        object-fit: cover;
        border-radius: 16px;
        flex-shrink: 0;
    }
    .artikel-content {
        flex: 1;
    }
    .artikel-title {
        color: #fff;
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
        line-height: 1.4;
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
        <div class="hero-header">
            <h1 class="hero-title">KAMPOENG HERITAGE<br>KAJOETANGAN</h1>
            <p class="hero-desc">Wisata bersejarah yang populer di Malang<br>dengan bangunan-bangunan peninggalan<br>masa kolonial.</p>
        </div>
        <img src="/images/hero-new.jpg" alt="Kampoeng Heritage Kajoetangan" class="hero-image">
    </div>

    <!-- Sejarah Section -->
    <div class="sejarah-section">
        <h2 class="section-title">SEJARAH</h2>
        <div class="sejarah-content">
            <img src="/images/sejarah-new.jpg" alt="Sejarah Kajoetangan" class="sejarah-image">
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
            <img src="/images/galeri-new-1.jpg" alt="Galeri 1" class="galeri-item">
            <img src="/images/galeri-new-2.jpg" alt="Galeri 2" class="galeri-item">
            <img src="/images/galeri-new-3.jpg" alt="Galeri 3" class="galeri-item">
            <img src="/images/galeri-new-4.jpg" alt="Galeri 4" class="galeri-item">
        </div>
    </div>

    <!-- Maps Section -->
    <div class="maps-section">
        <h2 class="section-title">MAPS</h2>
        <div class="maps-content">
            @php
                $embedUrl = '';
                if (Str::contains($maps_link, 'google.com/maps')) {
                    if (Str::contains($maps_link, '/embed')) {
                        $embedUrl = $maps_link;
                    } else {
                        // Attempt to simpler conversion if possible or fallback to a default if complex
                        // Regex to grab the part after /place/
                        if (preg_match('/\/maps\/place\/(.+)/', $maps_link, $matches)) {
                             // This is a naive conversion, Google Maps embed API usually requires more specific params (pb=...)
                             // often found in the 'Share -> Embed' feature.
                             // However, if the user inputs a standard link, we can TENTATIVELY try to use it 
                             // BUT proper embedding usually requires the `pb` parameter which is complex.
                             // A safer bet for "place" links without API key is /maps?q=...&output=embed but that is old.
                             // The admin panel logic used: preg_replace('/\/maps\/place\/(.+)/', '/maps/embed?pb=$1', $mapsUrl);
                             // We will try to rely on what the user inputs. 
                             // If the user inputs a "Share Link" (goo.gl or maps.app.goo.gl), it's hard to embed directly without expanding.
                             // Let's assume the user might input the Embed Link if they want it to show up, 
                             // OR we use the logic from admin panel.
                             $embedUrl = preg_replace('/\/maps\/place\/(.+)/', '/maps/embed?pb=$1', $maps_link);
                        }
                    }
                }
                // Fallback if empty or invalid, keep the one that was there or use the link if it seems to be embed
                if (empty($embedUrl) && Str::contains($maps_link, 'embed')) {
                    $embedUrl = $maps_link;
                }
                // Final fallback to hardcoded if we really can't figure it out, 
                // OR just show the user-provided link if it kind of looks like an embed?
                // Let's stick to the Admin Panel logic for consistency.
                if (empty($embedUrl) || !Str::contains($embedUrl, 'embed')) {
                     // If we can't make an embed link, maybe just leave the default one or try to construct one?
                     // Let's use the default one if conversion fails so we don't show a broken iframe.
                     $embedUrl = "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.003073964624!2d112.626944!3d-7.977222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd629e2e2e2e2e2%3A0x2e2e2e2e2e2e2e2e!2sKampoeng%20Heritage%20Kajoetangan!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid";
                }
            @endphp
            <iframe 
                src="{{ $embedUrl }}" 
                class="maps-embed"
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            <div class="maps-info">
                <h3 style="font-size: 2rem; margin-bottom: 0.5rem; color: #4e342e;">LOKASI KAMI</h3>
                <p style="font-size: 1.1rem; line-height: 1.6; margin-bottom: 24px;">Kampoeng Heritage Kajoetangan berada pada lokasi :</p>
                
                <div class="info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Jl. Raya Gempol - Malang, Kauman, Kec. Klojen, Kota Malang, Jawa Timur 65119</span>
                </div>
                <div class="info-item">
                    <i class="far fa-clock"></i>
                    <span>Jam Operasional : 07.00 - 20.00</span>
                </div>

                <a href="{{ $maps_btn_link }}" target="_blank" class="btn-google-maps">Google Maps</a>
            </div>
        </div>
    </div>

    <!-- Artikel Section -->
    <div class="artikel-section">
        <h2 class="section-title">ARTIKEL</h2>
        <div class="artikel-grid">
            @forelse($articles as $article)
            <a href="{{ $article->external_link ?? '#' }}" target="_blank" class="artikel-card">
                <img src="{{ asset($article->thumbnail_url) }}" alt="{{ $article->title }}" class="artikel-image">
                <div class="artikel-content">
                    <h3 class="artikel-title">{{ $article->title }}</h3>
                </div>
            </a>
            @empty
            <p style="grid-column: 1 / -1; text-align: center; color: #888;">Belum ada artikel terbaru.</p>
            @endforelse
        </div>
    </div>

@endsection
