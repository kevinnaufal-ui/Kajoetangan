@extends('admin.layout')

@section('content')
<h2 class="text-xl font-bold mb-4">Pesanan #{{ $ticket->id }}</h2>
<div class="bg-white p-4">
    <div><strong>Nama:</strong> {{ $ticket->name }}</div>
    <div><strong>Email:</strong> {{ $ticket->email }}</div>
    <div><strong>Telepon:</strong> {{ $ticket->phone }}</div>
    <div><strong>Type:</strong> {{ $ticket->type }}</div>
    <div><strong>Quantity:</strong> {{ $ticket->quantity }}</div>
    <div><strong>Free guide:</strong> {{ $ticket->free_guide ? 'Yes' : 'No' }}</div>
    <div><strong>Visit date:</strong> {{ $ticket->visit_date }}</div>
</div>
@endsection
