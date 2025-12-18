@extends('layout')
@section('title', 'Sejarah Kampoeng Heritage Kajoetangan')
@section('head')
<style>
    .page-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 2.5rem;
        margin: 0 0 32px 0;
        line-height: 1.2;
    }
    .btn-back {
        display: inline-block;
        margin-bottom: 24px;
        padding: 12px 32px;
        background: linear-gradient(135deg, #cfa98a, #b8926f);
        color: #5a2600;
        border-radius: 24px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(160, 74, 26, 0.2);
    }
    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(160, 74, 26, 0.3);
    }
    .sejarah-container {
        /* background: rgba(255, 242, 230, 0.6); Removed background */
        /* padding: 40px; Reduced padding */
        padding: 0 16px; 
        /* border-radius: 24px; */
        /* box-shadow: 0 4px 24px rgba(90, 38, 0, 0.08); Removed shadow */
    }
    .sejarah-row {
        display: flex;
        gap: 32px;
        align-items: flex-start;
        margin-bottom: 32px;
    }
    .sejarah-row:last-child {
        margin-bottom: 0;
    }
    .sejarah-row.reverse {
        flex-direction: row-reverse;
    }
    .sejarah-text {
        flex: 1;
    }
    .sejarah-text p {
        color: #5a2600;
        font-size: 1.1rem;
        line-height: 1.7;
        margin: 0 0 18px 0;
    }
    .sejarah-text p:last-child {
        margin-bottom: 0;
    }
    .sejarah-img {
        width: 280px;
        height: 180px;
        object-fit: cover;
        border-radius: 16px;
        flex-shrink: 0;
        box-shadow: 0 4px 16px rgba(90, 38, 0, 0.12);
    }
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }
        .sejarah-container {
            padding: 0;
        }
        .sejarah-row, .sejarah-row.reverse {
            flex-direction: column;
        }
        .sejarah-img {
            width: 100%;
            max-width: 320px;
        }
    }
</style>
@endsection
@section('content')
<div class="sejarah-container">
    <a href="/" class="btn-back">← Kembali</a>
    <h1 class="page-title">SEJARAH KAMPOENG HERITAGE KAJOETANGAN</h1>
    
    @if($history && $history->content)
        @php
            $allParagraphs = array_values(array_filter(preg_split('/\r\n|\r|\n/', $history->content), function($text) {
                return trim($text) !== '';
            }));
            // Chunk paragraphs into groups of 2
            $paragraphChunks = array_chunk($allParagraphs, 2);
            $images = $history->historyImages ? $history->historyImages->values() : collect();
            $count = max(count($paragraphChunks), $images->count());
        @endphp

        @for($i = 0; $i < $count; $i++)
            @php
                $chunk = $paragraphChunks[$i] ?? [];
                $img = $images->get($i);
                $isReverse = ($i % 2 != 0);
            @endphp
            @if(!empty($chunk) || $img)
                <div class="sejarah-row {{ $isReverse ? 'reverse' : '' }}">
                    <div class="sejarah-text">
                        @foreach($chunk as $p)
                            <p>{{ $p }}</p>
                        @endforeach
                    </div>
                    @if($img)
                        <img src="{{ asset($img->image_path) }}" alt="Sejarah" class="sejarah-img">
                    @endif
                </div>
            @endif
        @endfor

    @else
        <p>Belum ada data sejarah.</p>
    @endif
</div>

<style>
    .sejarah-row {
        align-items: center; /* Center align image vertically with text block */
    }
    .sejarah-row.reverse {
        flex-direction: row-reverse;
    }
</style>
@endsection
