@extends('layout')
@section('title', 'Konfirmasi Pembayaran | Kajoetangan')
@section('head')
<style>
    .page-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 2.5rem;
        margin-bottom: 32px;
        line-height: 1.2;
        text-transform: uppercase;
        text-align: center;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    .confirmation-card {
        max-width: 600px;
        margin: 0 auto;
        background: #fff;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border: 1px solid rgba(0,0,0,0.05);
    }
    .booking-summary {
        background: #fff5f5;
        padding: 24px;
        border-radius: 12px;
        margin-bottom: 32px;
        border-left: 5px solid #a04a1a;
    }
    .form-group {
        margin-bottom: 24px;
    }
    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 700;
        color: #5a2600;
    }
    .form-control-file {
        width: 100%;
        padding: 12px;
        border: 2px dashed #ddd;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s;
    }
    .form-control-file:hover {
        border-color: #a04a1a;
        background: #fafafa;
    }
    .btn-submit {
        display: block;
        width: 100%;
        background: linear-gradient(135deg, #a04a1a, #8b3d15);
        color: #fff;
        padding: 16px;
        border: none;
        border-radius: 12px;
        font-weight: 800;
        font-size: 1.1rem;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(160, 74, 26, 0.4);
    }
    .btn-back {
        display: block;
        text-align: center;
        margin-top: 16px;
        color: #888;
        font-weight: 600;
        text-decoration: none;
    }
    .btn-back:hover {
        color: #5a2600;
    }
</style>
@endsection
@section('content')
<h1 class="page-title">KONFIRMASI PEMBAYARAN</h1>

<div class="confirmation-card">
    <div class="booking-summary">
        <h3 style="margin-top:0; color:#a04a1a;">Detail Pesanan #{{ $booking->id }}</h3>
        <p style="margin: 8px 0;"><strong>Nama:</strong> {{ $booking->visitor_name }}</p>
        <p style="margin: 8px 0;"><strong>Total Tagihan:</strong> Rp.{{ number_format($booking->total_price, 0, ',', '.') }},00</p>
    </div>

    <form action="{{ route('booking.confirmation.submit', $booking->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="form-group">
            <label class="form-label">Upload Bukti Transfer</label>
            <input type="file" name="payment_proof" class="form-control-file" accept="image/*" required>
            <small style="display:block; margin-top:8px; color:#666;">Format: JPG, PNG, GIF. Max: 2MB.</small>
        </div>

        <button type="submit" class="btn-submit">Kirim Bukti Pembayaran</button>
        <a href="{{ route('pembayaran-pending', $booking->id) }}" class="btn-back">Kembali ke Halaman Pembayaran</a>
    </form>
</div>
@endsection
