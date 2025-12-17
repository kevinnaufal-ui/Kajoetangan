@extends('admin.layout')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Buat Akun Admin</h2>
    @if($errors->any())
        <div class="text-red-600 mb-3">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.register.post') }}">
        @csrf
        <div class="mb-3">
            <label class="block text-sm">Nama</label>
            <input type="text" name="name" class="w-full border p-2" required>
        </div>
        <div class="mb-3">
            <label class="block text-sm">Email</label>
            <input type="email" name="email" class="w-full border p-2" required>
        </div>
        <div class="mb-3">
            <label class="block text-sm">Password</label>
            <input type="password" name="password" class="w-full border p-2" required>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-green-600 text-white px-4 py-2 rounded">Buat Akun Admin</button>
            <a href="{{ route('admin.login') }}" class="text-sm text-blue-600">Sudah punya akun? Login</a>
        </div>
    </form>
</div>
@endsection
