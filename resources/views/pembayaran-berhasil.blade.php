@extends('layout')
@section('title', 'Pembayaran Berhasil | Kajoetangan')
@section('content')
@php
    $data = session('ticket_success');
@endphp
<h1 style="color:#5a2600;font-weight:900;">PEMBAYARAN BERHASIL</h1>
<div style="background:#a04a1a;color:#fff;padding:32px 32px 24px 32px;border-radius:24px;max-width:600px;margin:32px 0 32px 0;">
    <div style="display:flex;justify-content:space-between;font-weight:700;">
        <span>Tanggal Pembayaran</span>
        <span>{{ date('d F Y, H:i') }}</span>
    </div>
    <div style="margin-top:8px;">Metode Pembayaran <span style="float:right;">{{ $data['payment_method'] ?? '-' }}</span></div>
    <div>Tanggal Kunjungan <span style="float:right;">{{ $data['visit_date'] ?? '-' }}</span></div>
    <hr style="border:1px solid #fff3;margin:16px 0;">
    <div>Biaya Tiket <span style="float:right;">{{ $data['quantity'] ?? 0 }} x Rp.{{ number_format($data['ticket_price'] ?? 0,0,',','.') }},00</span></div>
    <div style="font-weight:700;">Rp.{{ number_format($data['total_ticket'] ?? 0,0,',','.') }},00</div>
    <div>Biaya Pemandu <span style="float:right;">Rp.{{ number_format($data['guide_fee'] ?? 0,0,',','.') }},00</span></div>
    <div>Biaya Admin <span style="float:right;">Rp.{{ number_format($data['admin_fee'] ?? 0,0,',','.') }},00</span></div>
    <div style="font-weight:700;font-size:1.2em;margin-top:12px;">TOTAL <span style="float:right;">Rp.{{ number_format($data['total'] ?? 0,0,',','.') }},00</span></div>
    <div style="font-weight:700;margin-top:12px;">STATUS <span style="float:right;">LUNAS</span></div>
</div>
<p style="font-size:1em;max-width:600px;">*Tiket telah dikirim melalui email, kesalahan penulisan email bukan bagian dari tanggung jawab kami</p>
<a href="/" style="display:inline-block;margin-top:12px;padding:12px 32px;background:#a04a1a;color:#fff;border-radius:18px;text-decoration:none;font-weight:700;">Kembali ke Beranda</a>
@endsection
