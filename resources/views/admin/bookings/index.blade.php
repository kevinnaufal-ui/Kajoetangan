@extends('admin.layout')

@section('content')
<h2 class="text-2xl font-bold mb-4">Pesanan Booking</h2>
    <div class="mb-4">
        <a href="{{ route('admin.bookings.index', ['status' => 'all']) }}" class="px-4 py-2 mr-2 rounded bg-gray-200 hover:bg-gray-300 text-gray-800 {{ request('status') == 'all' || !request('status') ? 'bg-gray-400 font-bold' : '' }}">Semua</a>
        <a href="{{ route('admin.bookings.index', ['status' => 'lunas']) }}" class="px-4 py-2 mr-2 rounded bg-green-100 hover:bg-green-200 text-green-800 {{ request('status') == 'lunas' ? 'bg-green-300 font-bold' : '' }}">Lunas</a>
        <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" class="px-4 py-2 mr-2 rounded bg-yellow-100 hover:bg-yellow-200 text-yellow-800 {{ request('status') == 'pending' ? 'bg-yellow-300 font-bold' : '' }}">
            Pending
            @if($pendingCount > 0)
                <span class="ml-1 px-2 py-0.5 rounded-full bg-red-500 text-white text-xs font-bold">{{ $pendingCount }}</span>
            @endif
        </a>
        <a href="{{ route('admin.bookings.index', ['status' => 'expired']) }}" class="px-4 py-2 rounded bg-red-100 hover:bg-red-200 text-red-800 {{ request('status') == 'expired' ? 'bg-red-300 font-bold' : '' }}">Expired</a>
    </div>

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
            <td>{{ $b->updated_at->format('d M Y H:i') }}</td>
            <td>
                @if($b->status == 'lunas')
                    <span class="px-2 py-1 rounded bg-green-100 text-green-800 text-xs font-bold">LUNAS</span>
                @elseif($b->status == 'expired')
                    <span class="px-2 py-1 rounded bg-red-100 text-red-800 text-xs font-bold">EXPIRED</span>
                @elseif($b->status == 'pending')
                    <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-800 text-xs font-bold">PENDING</span>
                @elseif($b->status == 'menunggu_verifikasi')
                    <span class="px-2 py-1 rounded bg-blue-100 text-blue-800 text-xs font-bold">VERIFIKASI</span>
                @else
                    {{ $b->status }}
                @endif
            </td>
            <td><a href="{{ route('admin.bookings.show',$b) }}" class="text-blue-600">Lihat</a></td>
        </tr>
    @endforeach
    </tbody>
    </table>

    <div class="mt-4">{{ $bookings->links() }}</div>
@endsection
