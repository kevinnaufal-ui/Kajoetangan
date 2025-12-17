@extends('admin.layout')

@section('content')
<div class="mb-6">
    <div class="bg-indigo-600 text-white rounded-lg p-6 shadow-md">
        <h1 class="text-2xl font-bold">Dashboard</h1>
        <p class="text-indigo-100 mt-1">Ringkasan cepat untuk mengelola konten pariwisata.</p>
    </div>
</div>

<div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
    <div class="bg-white p-4 rounded-lg shadow flex items-center gap-4">
        <div class="h-12 w-12 bg-yellow-100 text-yellow-700 rounded flex items-center justify-center">📷</div>
        <div>
            <div class="text-sm text-gray-500">Galeri menunggu</div>
            <div class="text-xl font-bold">{{ $galleries_pending }}</div>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow flex items-center gap-4">
        <div class="h-12 w-12 bg-green-100 text-green-700 rounded flex items-center justify-center">📅</div>
        <div>
            <div class="text-sm text-gray-500">Total acara</div>
            <div class="text-xl font-bold">{{ $events_count }}</div>
        </div>
    </div>

    <div class="bg-white p-4 rounded-lg shadow flex items-center gap-4">
        <div class="h-12 w-12 bg-blue-100 text-blue-700 rounded flex items-center justify-center">🎟️</div>
        <div>
            <div class="text-sm text-gray-500">Total pesanan tiket</div>
            <div class="text-xl font-bold">{{ $bookings_count }}</div>
        </div>
    </div>
</div>

<div class="mt-10">
    <h2 class="text-xl font-bold mb-4">Grafik Kedatangan Pengunjung (Minggu Ini)</h2>
    <canvas id="bookingChart" height="120"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('bookingChart').getContext('2d');
    const bookingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chart_labels ?? []),
            datasets: [{
                label: 'Jumlah Booking',
                data: @json($chart_values ?? []),
                backgroundColor: 'rgba(99,102,241,0.7)',
                borderRadius: 6,
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                        callback: function(value) {
                            if (Number.isInteger(value)) {
                                return value;
                            }
                            return null;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
