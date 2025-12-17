<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryPhoto;
use App\Models\Event;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'galleries_pending' => GalleryPhoto::where('status','pending')->count(),
            'events_count' => Event::count(),
            'bookings_count' => Booking::count(),
        ];

        // Grafik booking per hari minggu ini
        $startOfWeek = now()->startOfWeek();
        $endOfWeek = now()->endOfWeek();
        $bookings = Booking::whereBetween('booking_date', [$startOfWeek, $endOfWeek])->get();
        $days = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'];
        $chartData = array_fill_keys($days, 0);
        foreach ($bookings as $b) {
            $dayIdx = date('N', strtotime($b->booking_date)); // 1=Senin, 7=Minggu
            $chartData[$days[$dayIdx-1]]++;
        }
        $data['chart_labels'] = array_values($days);
        $data['chart_values'] = array_values($chartData);

        return view('admin.dashboard', $data);
    }
}
