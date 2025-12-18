<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::query();

        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $bookings = $query->orderBy('created_at','desc')->paginate(30);
        $pendingCount = Booking::where('status', 'pending')->count();
        return view('admin.bookings.index', compact('bookings', 'pendingCount'));
    }

    public function show(Booking $booking)
    {
        return view('admin.bookings.show', compact('booking'));
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return back()->with('status','Booking deleted');
    }

    public function approve(Booking $booking)
    {
        $booking->update(['status' => 'lunas']);
        return back()->with('status', 'Booking telah disetujui (LUNAS).');
    }

    public function reject(Booking $booking)
    {
        $booking->update(['status' => 'expired']);
        return back()->with('status', 'Booking telah ditolak (EXPIRED).');
    }
}
