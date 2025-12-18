@extends('layout')
@section('title', 'Pesan Tiket | Kajoetangan')
@section('head')
<style>
    .page-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 2.5rem;
        margin: 0 0 32px 0;
        line-height: 1.2;
    }
    .booking-layout {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 48px;
        align-items: start;
    }
    .booking-left, .booking-right {
        /* columns */
    }
    .section-title {
        color: #5a2600;
        font-weight: 900;
        font-size: 1.35rem;
        margin: 0 0 18px 0;
    }
    .form-input {
        width: 100%;
        padding: 14px 22px;
        margin-bottom: 14px;
        border-radius: 20px;
        border: 2px solid #cfa98a;
        font-size: 1.05rem;
        color: #5a2600;
        box-sizing: border-box;
        transition: border-color 0.2s ease;
    }
    .form-input:focus {
        outline: none;
        border-color: #a04a1a;
    }
    .form-input::placeholder {
        color: #a08070;
    }
    .form-row {
        display: flex;
        gap: 12px;
        margin-bottom: 12px;
        flex-wrap: wrap;
        align-items: center;
    }
    .form-select {
        padding: 10px 16px;
        border-radius: 16px;
        border: 2px solid #cfa98a;
        font-size: 0.9rem;
        color: #5a2600;
        background: #fff;
        cursor: pointer;
    }
    .form-select:focus {
        outline: none;
        border-color: #a04a1a;
    }
    .form-number {
        width: 70px;
        padding: 10px 12px;
        border-radius: 16px;
        border: 2px solid #cfa98a;
        font-size: 0.9rem;
        color: #5a2600;
        text-align: center;
        -moz-appearance: textfield;
    }
    .form-number::-webkit-outer-spin-button,
    .form-number::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .form-number:focus {
        outline: none;
        border-color: #a04a1a;
    }
    .number-input-wrapper {
        display: flex;
        align-items: center;
        gap: 0;
        background: #fff;
        border: 2px solid #cfa98a;
        border-radius: 20px;
        overflow: hidden;
    }
    .number-input-wrapper:focus-within {
        border-color: #a04a1a;
    }
    .number-btn {
        width: 36px;
        height: 40px;
        background: transparent;
        border: none;
        font-size: 1.2rem;
        font-weight: 700;
        color: #5a2600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .number-btn:hover {
        background: rgba(160, 74, 26, 0.1);
    }
    .number-input-wrapper input {
        width: 50px;
        padding: 10px 4px;
        border: none;
        font-size: 0.9rem;
        color: #5a2600;
        text-align: center;
        -moz-appearance: textfield;
        background: transparent;
    }
    .number-input-wrapper input::-webkit-outer-spin-button,
    .number-input-wrapper input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
    .number-input-wrapper input:focus {
        outline: none;
    }
    .form-note {
        font-size: 0.85rem;
        color: #5a2600;
        margin-bottom: 12px;
        line-height: 1.4;
    }
    .form-note span {
        font-size: 0.8rem;
        opacity: 0.7;
    }
    .form-checkbox {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        font-size: 0.9rem;
        color: #5a2600;
        cursor: pointer;
    }
    .form-checkbox input {
        display: none;
    }
    .custom-checkbox {
        width: 20px;
        height: 20px;
        border: 2px solid #cfa98a;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }
    .custom-checkbox::after {
        content: '';
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #a04a1a;
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    .form-checkbox input:checked + .custom-checkbox {
        border-color: #a04a1a;
    }
    .form-checkbox input:checked + .custom-checkbox::after {
        opacity: 1;
    }
    .form-checkbox:hover .custom-checkbox {
        border-color: #a04a1a;
    }
    .custom-radio {
        width: 20px;
        height: 20px;
        border: 2px solid #cfa98a;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
        flex-shrink: 0;
        position: relative;
    }
    .custom-radio::after {
        content: '';
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: #a04a1a;
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    .payment-option input:checked + .custom-radio {
        border-color: #a04a1a;
    }
    .payment-option input:checked + .custom-radio::after {
        opacity: 1;
    }
    .payment-box {
        background: linear-gradient(135deg, #a04a1a, #8b3d15);
        padding: 20px;
        border-radius: 16px;
        margin-bottom: 20px;
    }
    .payment-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 10px;
    }
    .payment-option {
        background: #fff;
        border-radius: 10px;
        padding: 8px 12px;
        text-align: center;
        cursor: pointer;
        font-size: 0.8rem;
        color: #5a2600;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
    }
    .payment-option:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .payment-option input {
        width: 14px;
        height: 14px;
    }
    .summary-box {
        background: rgba(207, 169, 138, 0.25);
        border-radius: 16px;
        padding: 24px;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 0.9rem;
        color: #5a2600;
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        font-weight: 900;
        font-size: 1.1rem;
        color: #5a2600;
        border-top: 2px solid #cfa98a;
        padding-top: 12px;
        margin-top: 8px;
    }
    .btn-submit {
        width: 100%;
        margin-top: 20px;
        padding: 14px 24px;
        background: linear-gradient(135deg, #a04a1a, #8b3d15);
        color: #fff;
        border: none;
        border-radius: 20px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(160, 74, 26, 0.3);
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(160, 74, 26, 0.4);
    }
    @media (max-width: 900px) {
        .booking-layout {
            grid-template-columns: 1fr;
            gap: 32px;
        }
        .payment-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    @media (max-width: 500px) {
        .page-title {
            font-size: 1.8rem;
        }
        .payment-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .form-row {
            flex-direction: column;
            align-items: stretch;
        }
        .form-select, .form-number {
            width: 100%;
        }
    }
</style>
@endsection
@section('content')
    <h1 class="page-title">PEMESANAN TIKET KAMPOENG HERITAGE KAJOETANGAN</h1>
    <form method="POST" action="{{ route('pesan-tiket.store') }}" onsubmit="return validateDate()">
        @csrf
        <div class="booking-layout">
            <div class="booking-left">
                @if(session('error'))
                    <div style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #fca5a5;">
                        {{ session('error') }}
                    </div>
                @endif
                <h2 class="section-title">DATA PENGUNJUNG</h2>
                <input type="text" name="name" placeholder="Nama" required class="form-input">
                <input type="text" name="phone" placeholder="No Telepon" required class="form-input">
                <input type="email" name="email" placeholder="Email" required class="form-input">
                
                <h2 class="section-title" style="margin-top:24px;">PEMESANAN TIKET</h2>
                <div class="form-row" style="display:grid; grid-template-columns:auto 1fr auto; gap:12px; align-items:center;">
                    <div class="number-input-wrapper">
                        <button type="button" class="number-btn" onclick="changeValue('date', -1)">−</button>
                        <input type="number" name="date" id="date" min="1" max="31" value="1" required>
                        <button type="button" class="number-btn" onclick="changeValue('date', 1)">+</button>
                    </div>
                    <div class="number-input-wrapper" style="flex:1;">
                        <button type="button" class="number-btn" onclick="changeMonth(-1)">−</button>
                        <input type="text" name="month" id="month" value="November" readonly style="flex:1; text-align:center; cursor:default;">
                        <button type="button" class="number-btn" onclick="changeMonth(1)">+</button>
                    </div>
                    <div class="number-input-wrapper">
                        <button type="button" class="number-btn" onclick="changeValue('year', -1)">−</button>
                        <input type="number" name="year" id="year" min="2025" max="2100" value="2025" required style="width:60px;">
                        <button type="button" class="number-btn" onclick="changeValue('year', 1)">+</button>
                    </div>
                </div>
                <div class="form-row" style="display:grid; grid-template-columns:auto 1fr; gap:12px; margin-top:12px; align-items:center;">
                    <div class="number-input-wrapper">
                        <button type="button" class="number-btn" onclick="changeValue('quantity', -1)">−</button>
                        <input type="number" name="quantity" id="quantity" min="1" value="1" required>
                        <button type="button" class="number-btn" onclick="changeValue('quantity', 1)">+</button>
                    </div>
                    <select name="type" required class="form-input" style="margin-bottom:0;">
                        <option value="tur">Tur / Rekreasi</option>
                        <option value="personal">Personal</option>
                    </select>
                </div>
                <div class="form-note">
                    Rp.5.000,00 / Tiket<br>
                    <span>*Anak dibawah 10 tahun tidak kena biaya (kecuali untuk jenis pemesanan tur / rekreasi)</span>
                </div>
                <label class="form-checkbox">
                    <input type="checkbox" id="guide">
                    <span class="custom-checkbox"></span>
                    <span>Pemandu <span style="opacity:0.7;">*jumlah tiket diatas 25 tiket</span></span>
                </label>


                <h2 class="section-title">METODE PEMBAYARAN</h2>
                <div class="payment-box" style="display:flex; justify-content:flex-start;">
                    <label class="payment-option" style="padding:12px 32px; font-size:1rem; font-weight:700; gap: 10px;">
                        <input type="radio" name="payment_method" value="QRIS" required checked style="display:none;">
                        <span class="custom-radio"></span>
                        <span>QRIS</span>
                    </label>
                </div>
            </div>
            
            <div class="booking-right">
                <h2 class="section-title">PEMBAYARAN</h2>
                <div class="summary-box">
                    <div class="summary-row">
                        <span>Jumlah Tiket</span>
                        <span id="summary-qty">1 Tiket</span>
                    </div>
                    <div class="summary-row">
                        <span>Biaya Tiket</span>
                        <span id="summary-ticket">1 x Rp 5.000</span>
                    </div>
                    <div class="summary-row">
                        <span>Subtotal Tiket</span>
                        <span id="summary-total-ticket">Rp.5.000,00</span>
                    </div>
                    <div class="summary-row">
                        <span>Biaya Pemandu</span>
                        <span id="summary-guide">Rp.0,00</span>
                    </div>
                    <div class="summary-row">
                        <span>Biaya Admin</span>
                        <span id="summary-admin">Rp.2.500,00</span>
                    </div>
                    <div class="summary-total">
                        <span>TOTAL</span>
                        <span id="summary-total">Rp.7.500,00</span>
                    </div>
                </div>
                <button type="submit" class="btn-submit">Bayar Sekarang</button>
            </div>
        </div>
    </form>
    <script>
    function formatRupiah(angka) {
        return 'Rp.' + angka.toLocaleString('id-ID') + ',00';
    }
    function changeValue(id, delta) {
        const input = document.getElementById(id);
        let value = parseInt(input.value) || 0;
        let min = parseInt(input.min) || 0;
        let max = parseInt(input.max) || 9999;
        value += delta;
        if (value < min) value = min;
        if (value > max) value = max;
        input.value = value;
        if (id === 'quantity') updateSummary();
    }
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    
    const today = new Date();
    let currentMonthIndex = today.getMonth();
    
    // Set default values to today
    document.getElementById('date').value = today.getDate();
    document.getElementById('month').value = months[currentMonthIndex];
    document.getElementById('year').value = today.getFullYear();

    function changeMonth(delta) {
        currentMonthIndex += delta;
        if (currentMonthIndex < 0) currentMonthIndex = 11;
        if (currentMonthIndex > 11) currentMonthIndex = 0;
        document.getElementById('month').value = months[currentMonthIndex];
    }
    function updateSummary() {
        let qty = parseInt(document.getElementById('quantity').value) || 1;
        let ticket = 5000;
        let admin = 2500;
        let guide = 0;
        let totalTicket = qty * ticket;
        let total = totalTicket + admin + guide;
        document.getElementById('summary-qty').innerText = qty + ' Tiket';
        document.getElementById('summary-ticket').innerText = qty + ' x Rp 5.000';
        document.getElementById('summary-total-ticket').innerText = formatRupiah(totalTicket);
        document.getElementById('summary-guide').innerText = formatRupiah(guide);
        document.getElementById('summary-admin').innerText = formatRupiah(admin);
        document.getElementById('summary-total').innerText = formatRupiah(total);
        
        // Update checkbox pemandu
        updateGuideCheckbox(qty);
    }
    
    function updateGuideCheckbox(qty) {
        const guideCheckbox = document.getElementById('guide');
        const guideLabel = guideCheckbox.closest('.form-checkbox');
        
        if (qty >= 25) {
            guideCheckbox.disabled = false;
            guideLabel.style.opacity = '1';
            guideLabel.style.cursor = 'pointer';
        } else {
            guideCheckbox.disabled = true;
            guideCheckbox.checked = false;
            guideLabel.style.opacity = '0.5';
            guideLabel.style.cursor = 'not-allowed';
        }
    }
    
    
    function validateDate() {
        const d = parseInt(document.getElementById('date').value);
        const mIdx = months.indexOf(document.getElementById('month').value);
        const y = parseInt(document.getElementById('year').value);
        
        const selectedDate = new Date(y, mIdx, d);
        const today = new Date();
        today.setHours(0,0,0,0);
        
        if (selectedDate < today) {
            alert('Tanggal pemesanan tidak valid (tidak boleh kurang dari hari ini).');
            return false;
        }
        return true;
    }

    document.getElementById('quantity').addEventListener('input', updateSummary);
    updateSummary();
    </script>
@endsection
