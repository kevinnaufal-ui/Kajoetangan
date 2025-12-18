@extends('admin.layout')

@section('content')
<div class="bg-white p-8 rounded-lg shadow-lg w-full">
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Login Admin</h2>
        <p class="text-gray-500 text-sm mt-2">Masuk untuk mengelola website</p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 text-red-600 p-3 rounded mb-4 text-sm">{{ $errors->first() }}</div>
    @endif
    @if(session('status'))
        <div class="bg-green-50 text-green-600 p-3 rounded mb-4 text-sm">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}">
        @csrf
        <div class="mb-5">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
            <input type="email" name="email" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition p-2 border" placeholder="admin@example.com" required>
        </div>
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" name="password" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 transition p-2 border" placeholder="••••••••" required>
        </div>
        
        <button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2.5 rounded-lg transition duration-200">
            Sign In
        </button>


    </form>
</div>
@endsection
