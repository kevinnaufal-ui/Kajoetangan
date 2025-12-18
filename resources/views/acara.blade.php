@extends('layout')
@section('title', 'Acara | Kajoetangan')
@section('head')
<style>
    .page-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 2.5rem;
        margin: 0 0 32px 0;
        line-height: 1.2;
    }
    .events-list {
        display: flex;
        flex-direction: column;
        gap: 40px;
    }
    .event-content {
        display: flex;
        gap: 32px;
        align-items: flex-start;
    }
    .event-image {
        width: 280px;
        height: 420px; /* Standard poster height */
        object-fit: cover;
        border-radius: 20px;
        flex-shrink: 0;
        box-shadow: 0 8px 32px rgba(90, 38, 0, 0.15);
    }
    .event-info {
        flex: 1;
    }
    .event-name {
        color: #5a2600;
        font-weight: 900;
        font-size: 2.2rem;
        margin: 0 0 20px 0;
    }
    .event-desc {
        color: #5a2600;
        font-size: 1.15rem;
        line-height: 1.7;
        margin: 0 0 28px 0;
    }
    .event-details {
        background: linear-gradient(135deg, #a04a1a, #8b3d15);
        color: #fff;
        padding: 28px 32px;
        border-radius: 20px;
        box-shadow: 0 6px 24px rgba(160, 74, 26, 0.25);
        display: flex;
        gap: 24px;
        align-items: stretch;
        min-height: 280px;
    }
    .event-details-left {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .event-venue {
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 14px;
    }
    .event-datetime {
        font-size: 1.15rem;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 15px;
    }
    .event-address {
        font-size: 1.15rem;
        display: flex;
        align-items: flex-start;
        gap: 10px;
        line-height: 1.4;
    }
    .event-map {
        flex: 1;
        min-height: 160px;
        border-radius: 12px;
        overflow: hidden;
    }
    .no-events {
        text-align: center;
        padding: 60px 20px;
        color: #5a2600;
        font-size: 1.2rem;
        background: rgba(207, 169, 138, 0.2);
        border-radius: 20px;
    }
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }
        .event-content {
            flex-direction: column;
        }
        .event-image {
            width: 100%;
            max-width: 320px;
            height: 300px;
        }
    }
</style>
@endsection
@section('content')
    <h1 class="page-title">ACARA KAMPOENG HERITAGE KAJOETANGAN</h1>
    
    @if($events->count() > 0)
        <div class="events-list">
            @foreach($events as $event)
            <div class="event-content">
                @if($event->image_url)
                    <img src="{{ $event->image_url }}" alt="{{ $event->title }}" class="event-image">
                @else
                    <div class="event-image" style="background: linear-gradient(135deg, #cfa98a, #a04a1a); display:flex; align-items:center; justify-content:center; color:#fff; font-size:1.5rem; font-weight:700;">
                        📅
                    </div>
                @endif
                <div class="event-info">
                    <h2 class="event-name">{{ strtoupper($event->title) }}</h2>
                    @if($event->description)
                        <p class="event-desc">{{ $event->description }}</p>
                    @endif
                    <div class="event-details">
                        <div class="event-details-left">
                            @if($event->location)
                                <div class="event-venue">{{ $event->location }}</div>
                            @endif
                            <div class="event-datetime">
                                <span>📅</span>
                                <span>{{ $event->event_date->translatedFormat('d F Y, \\P\\u\\k\\u\\l H:i') }}</span>
                            </div>
                            @if($event->address)
                                <div class="event-address">
                                    <span>📍</span>
                                    <span>{{ $event->address }}</span>
                                </div>
                            @endif
                        </div>
                        @if($event->map_embed_url)
                        <div class="event-map">
                            <iframe 
                                src="{{ $event->map_embed_url }}" 
                                width="100%" 
                                height="100%" 
                                style="border:0; border-radius:12px;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="no-events">
            Belum ada acara yang dijadwalkan. Pantau terus halaman ini!
        </div>
    @endif
@endsection
