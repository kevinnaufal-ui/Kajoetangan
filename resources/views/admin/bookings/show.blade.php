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
</div>
@endsection
