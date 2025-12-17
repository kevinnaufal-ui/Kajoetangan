@extends('admin.layout')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Admin Login</h2>
    @if($errors->any())
        <div class="text-red-600 mb-3">{{ $errors->first() }}</div>
    @endif
    @if(session('status'))
        <div class="text-green-600 mb-3">{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="mb-3">
            <label class="block text-sm">Email</label>
            <input type="email" name="email" class="w-full border p-2" required>
        </div>
        <div class="mb-3">
            <label class="block text-sm">Password</label>
            <input type="password" name="password" class="w-full border p-2" required>
        </div>
        <div class="flex items-center justify-between">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">Login</button>
            <a href="{{ route('admin.register') }}" class="text-sm text-blue-600">Belum punya akun? Buat akun</a>
        </div>
    </form>
</div>
@endsection
