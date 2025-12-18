@extends('layout')
@section('title', 'Pembayaran Berhasil | Kajoetangan')
@section('head')
<style>
    .page-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 2.5rem;
        margin-bottom: 32px;
        line-height: 1.2;
        text-transform: uppercase;
    }
    .payment-success-card {
        background: #a04a1a;
        color: #fff;
        padding: 32px;
        border-radius: 24px;
        width: 100%; /* Full width */
        margin-bottom: 32px;
    }
    .payment-row {
        display: flex;
        justify-content: space-between;
        font-weight: 700;
        font-size: 1.1rem;
    }
    .payment-detail {
        margin-top: 8px;
        font-size: 1.1rem;
    }
    .payment-divider {
        border: 1px solid rgba(255,255,255,0.3);
        margin: 24px 0;
    }
    .payment-total {
        font-weight: 700;
        font-size: 1.4em;
        margin-top: 16px;
    }
    .payment-status {
        font-weight: 700;
        font-size: 1.1em;
        margin-top: 16px;
    }
    .payment-note {
        font-size: 1rem;
        color: #5a2600;
        margin-bottom: 24px;
        font-style: italic;
    }
    .btn-home {
        display: inline-block;
        padding: 14px 32px;
        background: cubic-bezier(0.4, 0, 0.2, 1);
        background-color: #a04a1a;
        color: #fff;
        border-radius: 18px;
        text-decoration: none;
        font-weight: 700;
        transition: all 0.2s;
    }
    .btn-home:hover {
        background-color: #8b3d15;
        transform: translateY(-2px);
    }
    .float-right {
        float: right;
    }
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem;
        }
        .payment-success-card {
            padding: 24px;
        }
    }
</style>
@endsection
@section('content')
@php
    $data = session('ticket_success');
@endphp
<h1 class="page-title">PEMBAYARAN BERHASIL</h1>

<div class="payment-success-card">
    <div class="payment-row">
        <span>Tanggal Pembayaran</span>
        <span>{{ date('d F Y, H:i') }}</span>
    </div>
    
    <div class="payment-detail">
        Metode Pembayaran 
        <span class="float-right">{{ $data['payment_method'] ?? '-' }}</span>
    </div>
    
    <div class="payment-detail">
        Tanggal Kunjungan 
        <span class="float-right">{{ $data['visit_date'] ?? '-' }}</span>
    </div>
    
    <hr class="payment-divider">
    
    <div class="payment-detail">
        Biaya Tiket 
        <span class="float-right">{{ $data['quantity'] ?? 0 }} x Rp.{{ number_format($data['ticket_price'] ?? 0,0,',','.') }},00</span>
    </div>
    
    <div class="payment-detail" style="font-weight:700;">
        <span class="float-right">Rp.{{ number_format($data['total_ticket'] ?? 0,0,',','.') }},00</span>
        &nbsp; <!-- Spacer to maintain line height -->
    </div>
    
    <div class="payment-detail">
        Biaya Pemandu 
        <span class="float-right">Rp.{{ number_format($data['guide_fee'] ?? 0,0,',','.') }},00</span>
    </div>
    
    <div class="payment-detail">
        Biaya Admin 
        <span class="float-right">Rp.{{ number_format($data['admin_fee'] ?? 0,0,',','.') }},00</span>
    </div>
    
    <div class="payment-total">
        TOTAL 
        <span class="float-right">Rp.{{ number_format($data['total'] ?? 0,0,',','.') }},00</span>
    </div>
    
    @php
        $realStatus = null;
        if(isset($data['id'])) {
            $realStatus = \App\Models\Booking::find($data['id'])?->status;
        }
        $displayStatus = $realStatus ?? ($data['status'] ?? 'LUNAS');
    @endphp

    <div class="payment-status">
        STATUS 
        @if($displayStatus == 'pending' || $displayStatus == 'menunggu_verifikasi')
            <span class="float-right" style="background:#ffc107; color:#000; padding:4px 12px; border-radius:8px;">PENDING</span>
        @elseif($displayStatus == 'lunas')
             <span class="float-right" style="background:#28a745; color:#fff; padding:4px 12px; border-radius:8px;">LUNAS</span>
        @elseif($displayStatus == 'expired')
             <span class="float-right" style="color:red;">EXPIRED</span>
        @else
            <span class="float-right">{{ strtoupper($displayStatus) }}</span>
        @endif
    </div>
</div>

<p class="payment-note">*Tiket telah dikirim melalui email, kesalahan penulisan email bukan bagian dari tanggung jawab kami</p>

<a href="/" class="btn-home">Kembali ke Beranda</a>
@endsection
