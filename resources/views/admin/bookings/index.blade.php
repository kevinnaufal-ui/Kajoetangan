@extends('admin.layout')

@section('content')
<h2 class="text-2xl font-bold mb-4">Pesanan Booking</h2>
<table class="w-full bg-white">
    <thead><tr><th>ID</th><th>Nama</th><th>Email</th><th>Telepon</th><th>Type</th><th>Qty</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
    @foreach($bookings as $b)
        <tr class="border-t">
            <td>{{ $b->id }}</td>
            <td>{{ $b->visitor_name }}</td>
            <td>{{ $b->visitor_email }}</td>
            <td>{{ $b->visitor_phone }}</td>
            <td>{{ $b->visit_type }}</td>
            <td>{{ $b->ticket_quantity }}</td>
            <td>{{ $b->booking_date }}</td>
            <td>{{ $b->status }}</td>
            <td><a href="{{ route('admin.bookings.show',$b) }}" class="text-blue-600">Lihat</a></td>
        </tr>
    @endforeach
    </tbody>
    </table>

    <div class="mt-4">{{ $bookings->links() }}</div>
@endsection
