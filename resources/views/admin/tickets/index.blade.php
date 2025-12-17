@extends('admin.layout')

@section('content')
<h2 class="text-xl font-bold mb-4">Pesanan Tiket</h2>
<table class="w-full bg-white">
    <thead><tr><th>ID</th><th>Nama</th><th>Email</th><th>Telepon</th><th>Type</th><th>Qty</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr></thead>
    <tbody>
    @foreach($tickets as $t)
        <tr class="border-t">
            <td>{{ $t->id }}</td>
            <td>{{ $t->name }}</td>
            <td>{{ $t->email }}</td>
            <td>{{ $t->phone }}</td>
            <td>{{ $t->type }}</td>
            <td>{{ $t->quantity }}</td>
            <td>{{ $t->visit_date }}</td>
            <td>{{ $t->status }}</td>
            <td><a href="{{ route('admin.tickets.show',$t) }}" class="text-blue-600">Lihat</a></td>
        </tr>
    @endforeach
    </tbody>
    </table>

    <div class="mt-4">{{ $tickets->links() }}</div>
@endsection
