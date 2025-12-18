@extends('admin.layout')

@section('content')
<h2 class="text-xl font-bold mb-4">Booking #{{ $booking->id }}</h2>
<div class="bg-white p-4">
    <div><strong>Nama:</strong> {{ $booking->visitor_name }}</div>
    <div><strong>Email:</strong> {{ $booking->visitor_email }}</div>
    <div><strong>Telepon:</strong> {{ $booking->visitor_phone }}</div>
    <div><strong>Type:</strong> {{ $booking->visit_type }}</div>
    <div><strong>Quantity:</strong> {{ $booking->ticket_quantity }}</div>
    <div><strong>Free guide:</strong> {{ $booking->is_free_guide ? 'Yes' : 'No' }}</div>
    <div><strong>Booking date:</strong> {{ $booking->booking_date }}</div>
    <div><strong>Status:</strong> <span class="px-2 py-1 rounded {{ $booking->status == 'lunas' ? 'bg-green-200' : ($booking->status == 'expired' ? 'bg-red-200' : 'bg-yellow-200') }}">{{ $booking->status }}</span></div>

    @if($booking->payment_proof)
        <div class="mt-6 border-t pt-4">
            <h3 class="font-bold text-lg mb-2">Bukti Pembayaran</h3>
            <img src="{{ asset($booking->payment_proof) }}" alt="Bukti Pembayaran" class="max-w-md border rounded shadow-sm">
        </div>
    @else
        <div class="mt-6 text-gray-500 italic border-t pt-4">Belum ada bukti pembayaran yang diupload.</div>
    @endif

    @if($booking->status == 'pending' || $booking->status == 'menunggu_verifikasi')
        <div class="mt-4 flex gap-2">
            <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST" onsubmit="return confirm('Terima pembayaran ini?')">
                @csrf
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 font-bold">Terima (ACC)</button>
            </form>
            <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" onsubmit="return confirm('Tolak pembayaran ini?')">
                @csrf
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 font-bold">Tolak (Reject)</button>
            </form>
        </div>
    @endif
</div>
@endsection
