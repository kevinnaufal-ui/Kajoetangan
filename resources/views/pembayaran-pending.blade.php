@extends('layout')
@section('title', 'Menunggu Pembayaran | Kajoetangan')
@section('title', 'Menunggu Pembayaran | Kajoetangan')
@section('head')
<style>
    .page-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 2.5rem;
        margin-bottom: 32px;
        line-height: 1.2;
        text-transform: uppercase;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
    }
    .pending-layout {
        display: flex;
        gap: 32px;
        flex-wrap: wrap;
        align-items: stretch;
    }
    .pending-details {
        flex: 1;
        min-width: 300px;
        background: linear-gradient(135deg, #a04a1a, #8b3d15);
        color: #fff;
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 10px 30px rgba(160, 74, 26, 0.2);
        display: flex;
        flex-direction: column;
    }
    .pending-payment {
        flex: 1;
        min-width: 300px;
        background: #fff;
        border-radius: 24px;
        padding: 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid rgba(0,0,0,0.05);
    }
    .payment-row {
        display: flex;
        justify-content: space-between;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 12px;
        opacity: 0.9;
    }
    .payment-detail {
        margin-top: 12px;
        font-size: 1.1rem;
        line-height: 1.6;
    }
    .payment-value {
        float: right;
        font-weight: 600;
    }
    .payment-divider {
        border: 1px solid rgba(255,255,255,0.2);
        margin: 24px 0;
    }
    .payment-total {
        font-weight: 800;
        font-size: 1.5em;
        margin-top: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .status-badge {
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        padding: 6px 16px;
        border-radius: 12px;
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 1px;
        display: inline-block;
        backdrop-filter: blur(5px);
    }
    
    /* Right Column Styles */
    .qris-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 1.5rem;
        margin: 0 0 16px 0;
        text-transform: uppercase;
    }
    .qris-image {
        width: 100%;
        max-width: 280px;
        height: auto;
        margin-bottom: 24px;
        border-radius: 12px;
        border: 8px solid #f5f5f5;
    }
    .timer-label {
        font-weight: 700;
        color: #888;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 8px;
    }
    .timer-container {
        font-family: 'Courier New', monospace;
        font-size: 2.5rem;
        font-weight: 900;
        color: #d32f2f;
        margin-bottom: 24px;
        background: #fff5f5;
        padding: 10px 24px;
        border-radius: 12px;
        display: inline-block;
    }
    .payment-instruction {
        color: #5a2600;
        margin-bottom: 24px;
        font-size: 1.05rem;
        line-height: 1.6;
        max-width: 80%;
    }
    
    .btn-cancel {
        margin-top: auto;
        background: transparent;
        color: #888;
        border: 2px solid #ddd;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s;
        width: 100%;
        text-transform: uppercase;
    }
    .btn-cancel:hover {
        border-color: #d32f2f;
        color: #d32f2f;
        background: rgba(211, 47, 47, 0.05);
    }

    @media (max-width: 768px) {
        .pending-layout {
            flex-direction: column;
        }
        .pending-details, .pending-payment {
            padding: 24px;
        }
    }
</style>
@endsection
@section('content')
<h1 class="page-title">MENUNGGU PEMBAYARAN</h1>

<div class="pending-layout">
    <!-- Left Column: Details -->
    <div class="pending-details">
        <div class="payment-row">
            <span>ID Pesanan</span>
            <span style="font-family: monospace; font-size: 1.2rem;">#{{ $booking->id }}</span>
        </div>
        
        <div class="payment-detail">
            Nama Pengunjung 
            <span class="payment-value">{{ $booking->visitor_name }}</span>
        </div>

        <div class="payment-detail">
            Tanggal Kunjungan 
            <span class="payment-value">{{ \Carbon\Carbon::parse($booking->booking_date)->format('d F Y') }}</span>
        </div>
        
        <hr class="payment-divider">
        
        <div class="payment-detail">
            Tiket (Qty: {{ $booking->ticket_quantity }})
            <span class="payment-value">Rp.{{ number_format($booking->total_price - 2500, 0, ',', '.') }},00</span>
        </div>
        
        <div class="payment-detail">
            Biaya Admin 
            <span class="payment-value">Rp.2.500,00</span>
        </div>
        
        <div class="payment-total">
            <span>TOTAL</span>
            <span>Rp.{{ number_format($booking->total_price, 0, ',', '.') }},00</span>
        </div>
        
        <div style="margin-top: 32px; display: flex; justify-content: space-between; align-items: center;">
            <span style="opacity: 0.8; font-weight: 600;">Status Pembayaran</span>
            <span class="status-badge">PENDING</span>
        </div>
    </div>

    <!-- Right Column: QRIS & Timer -->
    <div class="pending-payment">
        <h3 class="qris-title">SCAN QRIS</h3>
        <p class="payment-instruction">Silahkan scan kode QR di bawah ini menggunakan aplikasi e-wallet atau mobile banking Anda.</p>
        
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/1200px-QR_code_for_mobile_English_Wikipedia.svg.png" alt="QRIS Code" class="qris-image">
        
        <div class="timer-label">Sisa Waktu Pembayaran</div>
        <div class="timer-container" id="countdown">15:00</div>
        
        <div id="loading-check" style="display:none; color:#a04a1a; font-weight:700; margin-bottom: 16px;">
            <i class="fas fa-spinner fa-spin"></i> Mengecek pembayaran...
        </div>

        <a href="{{ route('booking.confirmation', $booking->id) }}" style="display:block; width:100%; background:#28a745; color:white; padding:12px 24px; border-radius:12px; font-weight:700; text-align:center; text-decoration:none; margin-bottom:12px; text-transform:uppercase; transition:all 0.2s;" onmouseover="this.style.background='#218838'" onmouseout="this.style.background='#28a745'">
            Sudah Dibayar
        </a>

        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" style="width: 100%;">
            @csrf
            <button type="submit" class="btn-cancel" onclick="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                Batalkan Pesanan
            </button>
        </form>
    </div>
</div>

<script>
    // Timer Logic
    let timeLeft = 15 * 60; // 15 minutes in seconds
    const countdownEl = document.getElementById('countdown');
    
    const timerInterval = setInterval(() => {
        const minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;
        
        seconds = seconds < 10 ? '0' + seconds : seconds;
        
        countdownEl.innerHTML = `${minutes}:${seconds}`;
        
        if (timeLeft > 0) {
            timeLeft--;
        } else {
            clearInterval(timerInterval);
            countdownEl.innerHTML = "EXPIRED";
            countdownEl.style.color = "#888";
        }
    }, 1000);

    // Polling Logic
    const bookingId = {{ $booking->id }};
    const checkStatusUrl = "{{ route('check-payment-status', $booking->id) }}";
    
    function checkStatus() {
        // document.getElementById('loading-check').style.display = 'block'; // Optional visual feedback
        fetch(checkStatusUrl)
            .then(response => response.json())
            .then(data => {
                // document.getElementById('loading-check').style.display = 'none';
                if (data.status === 'lunas' || data.status === 'paid') {
                    window.location.href = "{{ route('pembayaran-berhasil') }}";
                }
            })
            .catch(error => {
                console.error('Error checking status:', error);
            });
    }

    // Check every 3 seconds
    setInterval(checkStatus, 3000);
</script>
@endsection
