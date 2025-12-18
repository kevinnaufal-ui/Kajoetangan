@extends('layout')
@section('title', 'Tentang | Kajoetangan')
@section('head')
<style>
    .page-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 2.5rem;
        margin: 0 0 32px 0;
        line-height: 1.2;
    }
    .tentang-content {
        /* no max-width to match other pages */
    }
    .tentang-content p {
        color: #5a2600;
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 18px;
    }
    .tentang-content ol {
        padding-left: 20px;
        color: #5a2600;
    }
    .tentang-content li {
        margin-bottom: 20px;
        line-height: 1.7;
    }
    .tentang-content li b {
        color: #5a2600;
        font-size: 1.15rem;
    }
    .tentang-content ol ol {
        margin-top: 12px;
    }
    .tentang-content ol ol li {
        margin-bottom: 8px;
    }
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }
    }
</style>
@endsection
@section('content')
    <h1 class="page-title">TENTANG KAMI</h1>
    <div class="tentang-content">
        @if($about)
            <div style="margin-bottom: 40px;">
                {!! $about !!} 
            </div>
        @else
            <p>Deskripsi belum tersedia.</p>
        @endif

        @if($contact)
            <h2 style="color: #5a2600; font-weight: 900; font-size: 1.8rem; margin-bottom: 20px;">KONTAK KAMI</h2>
            <div style="margin-bottom: 40px;">
                {!! $contact !!}
            </div>
        @endif
    </div>
@endsection
