@extends('layout')
@section('title', 'Pesan Tiket | Kajoetangan')
@section('content')
    <h1 style="color:#5a2600;font-weight:900;">PEMESANAN TIKET KAMPOENG HERITAGE KAJOETANGAN</h1>
    <form method="POST" action="{{ route('pesan-tiket.store') }}" style="margin:32px 0;max-width:600px;">
        @csrf
        <h2 style="color:#7a3a0a;">DATA PENGUNJUNG</h2>
        <input type="text" name="name" placeholder="Nama" required style="width:100%;padding:16px 24px;margin-bottom:16px;border-radius:32px;border:1px solid #a04a1a;">
        <input type="text" name="phone" placeholder="No Telepon" required style="width:100%;padding:16px 24px;margin-bottom:16px;border-radius:32px;border:1px solid #a04a1a;">
        <input type="email" name="email" placeholder="Email" required style="width:100%;padding:16px 24px;margin-bottom:24px;border-radius:32px;border:1px solid #a04a1a;">
        <h2 style="color:#7a3a0a;">PEMESANAN TIKET</h2>
        <div style="display:flex;gap:16px;margin-bottom:16px;">
            <input type="number" name="date" min="1" max="31" value="1" required style="width:80px;padding:12px 0 12px 16px;border-radius:18px;border:1px solid #a04a1a;">
            <select name="month" required style="padding:12px 24px;border-radius:18px;border:1px solid #a04a1a;">
                <option value="November">November</option>
                <option value="Desember">Desember</option>
            </select>
            <input type="number" name="year" min="2025" max="2100" value="2025" required style="width:90px;padding:12px 0 12px 16px;border-radius:18px;border:1px solid #a04a1a;">
        </div>
        <div style="display:flex;gap:16px;margin-bottom:16px;">
            <input type="number" name="quantity" id="quantity" min="1" value="1" required style="width:80px;padding:12px 0 12px 16px;border-radius:18px;border:1px solid #a04a1a;">
            <select name="type" required style="padding:12px 24px;border-radius:18px;border:1px solid #a04a1a;">
                <option value="tur">Tur / Rekreasi</option>
                <option value="personal">Personal</option>
            </select>
        </div>
        <div style="margin-bottom:16px;">Rp.5000,00 / Tiket <br><span style="font-size:0.95em;">*Anak dibawah 10 tahun tidak kena biaya (kecuali untuk jenis pemesanan tur / rekreasi)</span></div>
        <div style="margin-bottom:16px;"><input type="checkbox"> Pemandu <span style="font-size:0.95em;">*jumlah tiket diatas 25 tiket.</span></div>
        <h2 style="color:#7a3a0a;">METODE PEMBAYARAN</h2>
        <div style="background:#a04a1a;padding:24px 16px;border-radius:24px;margin-bottom:24px;">
            <div style="display:flex;flex-wrap:wrap;gap:16px;justify-content:space-between;">
                @foreach(['gopay','DANA','ShopeePay','OVO','BCA','BRI','BNI','Mandiri','QRIS','LinkAja!'] as $pay)
                <label style="background:#fff;border-radius:12px;padding:8px 16px;min-width:120px;text-align:center;margin-bottom:8px;cursor:pointer;">
                    <input type="radio" name="payment_method" value="{{ $pay }}" required style="margin-right:8px;">{{ $pay }}
                </label>
                @endforeach
            </div>
        </div>
        <h2 style="color:#7a3a0a;">PEMBAYARAN</h2>
        <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;" id="summary-box">
            <div>Jumlah Tiket <span style="float:right;" id="summary-qty">1 Tiket</span></div>
            <div>Biaya Tiket <span style="float:right;" id="summary-ticket">1 x Rp 5000.00</span></div>
            <div id="summary-total-ticket">Rp.5.000,00</div>
            <div>Biaya Pemandu <span style="float:right;" id="summary-guide">Rp.0.00</span></div>
            <div>Biaya Admin <span style="float:right;" id="summary-admin">Rp.2.500,00</span></div>
            <div style="font-weight:700;font-size:1.2em;">TOTAL <span style="float:right;" id="summary-total">Rp.7.500,00</span></div>
        </div>
        <button type="submit" style="margin-top:18px;padding:12px 48px;background:#a04a1a;color:#fff;border:none;border-radius:24px;font-size:1.1em;font-weight:700;cursor:pointer;">Bayar</button>
    </form>
    <script>
    function formatRupiah(angka) {
        return 'Rp.' + angka.toLocaleString('id-ID') + ',00';
    }
    function updateSummary() {
        let qty = parseInt(document.getElementById('quantity').value) || 1;
        let ticket = 5000;
        let admin = 2500;
        let guide = (qty > 25) ? 0 : 0;
        let totalTicket = qty * ticket;
        let total = totalTicket + admin + guide;
        document.getElementById('summary-qty').innerText = qty + ' Tiket';
        document.getElementById('summary-ticket').innerText = qty + ' x Rp 5000.00';
        document.getElementById('summary-total-ticket').innerText = formatRupiah(totalTicket);
        document.getElementById('summary-guide').innerText = formatRupiah(guide);
        document.getElementById('summary-admin').innerText = formatRupiah(admin);
        document.getElementById('summary-total').innerText = formatRupiah(total);
    }
    document.getElementById('quantity').addEventListener('input', updateSummary);
    updateSummary();
    </script>
    </form>
@endsection
