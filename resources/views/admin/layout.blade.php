<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin Panel - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* small customizations */
        .brand { font-weight:700; letter-spacing: -0.5px }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    @if(request()->routeIs('admin.login') || request()->routeIs('admin.register'))
        <div class="min-h-screen flex items-center justify-center">
            <main class="w-full max-w-md px-4">
                @yield('content')
            </main>
        </div>
    @else
        <div class="flex min-h-screen">
            <!-- Sidebar (hidden content on auth pages) -->
            <!-- Sidebar (responsive) -->
            <div id="sidebar-backdrop" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>
            <aside id="admin-sidebar" class="w-64 bg-white border-r fixed inset-y-0 left-0 z-50 transform -translate-x-full lg:static lg:translate-x-0 transition-transform duration-200">
                <div class="p-6">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 bg-indigo-600 text-white rounded flex items-center justify-center">A</div>
                        <div>
                            <div class="brand text-lg">{{ config('app.name','Admin') }}</div>
                            <div class="text-xs text-gray-500">Panel Admin</div>
                        </div>
                    </div>
                </div>
                <nav class="px-4 py-2">
                    <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-200 font-bold' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.history') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.history*') ? 'bg-gray-200 font-bold' : '' }}">Sejarah</a>
                    <a href="{{ route('admin.maps') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.maps*') ? 'bg-gray-200 font-bold' : '' }}">Maps</a>
                    <a href="{{ route('admin.articles.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.articles*') ? 'bg-gray-200 font-bold' : '' }}">Artikel</a>
                    <a href="{{ route('admin.galleries.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.galleries*') ? 'bg-gray-200 font-bold' : '' }}">Galeri</a>
                    <a href="{{ route('admin.events.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.events*') ? 'bg-gray-200 font-bold' : '' }}">Acara</a>
                    <a href="{{ route('admin.bookings.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.bookings*') ? 'bg-gray-200 font-bold' : '' }} flex justify-between items-center">
                        Pesen Tiket
                        @if(isset($pendingBookingCount) && $pendingBookingCount > 0)
                            <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">{{ $pendingBookingCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('admin.about') }}" class="block px-3 py-2 rounded hover:bg-gray-100 {{ request()->routeIs('admin.about*') ? 'bg-gray-200 font-bold' : '' }}">Tentang</a>
                </nav>

                <!--
                <div class="absolute left-0 bottom-0 px-4 pb-4 w-64 max-w-xs">
                    <form id="delete-account-form" method="POST" action="#">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="block w-full text-left px-3 py-2 rounded bg-gray-200 text-gray-400 cursor-not-allowed">Hapus Akun (coming soon)</button>
                    </form>
                </div>

                <div id="deleteAccountModal" class="fixed inset-0 z-50 flex items-center justify-end bg-black bg-opacity-40 hidden">
                    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md mr-12">
                        <div class="font-bold text-xl mb-4 text-red-700">Konfirmasi Hapus Akun</div>
                        <div class="mb-6 text-base text-gray-700">Apakah Anda yakin ingin menghapus akun ini? <b>Tindakan ini tidak dapat dibatalkan.</b></div>
                        <div class="flex justify-end gap-3">
                            <button onclick="hideDeleteModal()" class="px-4 py-2 rounded bg-gray-100 hover:bg-gray-200">Batal</button>
                            <button onclick="submitDeleteAccount()" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Ya, Hapus Akun</button>
                        </div>
                    </div>
                </div>
                -->
            </aside>

            <!-- Main content -->
            <div class="flex-1">
                <header class="bg-white border-b">
                    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <button id="sidebar-toggle" class="lg:hidden px-2 py-1 rounded bg-gray-100">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                            </button>
                            <div class="text-lg font-semibold">Admin</div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="hidden sm:block text-sm text-gray-600">Hi, {{ session('admin_name') ?? 'Admin' }}</div>
                            @if(session('admin_name'))
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <button class="text-sm text-red-600">Logout</button>
                                </form>
                            @else
                                <a href="{{ route('admin.login') }}" class="text-sm text-indigo-600">Login</a>
                            @endif
                        </div>
                    </div>
                </header>

                <main class="max-w-7xl mx-auto p-6">
                    @if(session('status'))
                        <div class="flex justify-center mb-6">
                            <div class="bg-green-50 border border-green-200 text-green-800 px-8 py-4 rounded shadow text-lg w-full max-w-2xl text-center font-semibold">
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif
                    @yield('content')
                </main>
            </div>
        </div>
    @endif

    <script>
        // mobile menu toggle (simple)
        // mobile menu toggle
        const btn = document.getElementById('sidebar-toggle');
        const sidebar = document.getElementById('admin-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }

        if(btn){
            btn.addEventListener('click', toggleSidebar);
            backdrop.addEventListener('click', toggleSidebar);
        }

        // Modal konfirmasi hapus akun
        function showDeleteModal() {
            document.getElementById('deleteAccountModal').classList.remove('hidden');
        }
        function hideDeleteModal() {
            document.getElementById('deleteAccountModal').classList.add('hidden');
        }
        function submitDeleteAccount() {
            document.getElementById('delete-account-form').submit();
        }
    </script>
</body>
</html>
