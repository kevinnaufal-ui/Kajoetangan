<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Booking;

class TicketController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'date' => 'required',
            'month' => 'required',
            'year' => 'required',
            'quantity' => 'required|integer|min:1',
            'type' => 'required',
            'payment_method' => 'required',
        ]);

        $quantity = (int) $request->quantity;
        $ticket_price = 5000;
        $admin_fee = 2500;
        $guide_fee = 0;
        $is_free_guide = $quantity > 25;
        $total_ticket = $quantity * $ticket_price;
        $total = $total_ticket + $admin_fee + $guide_fee;

        // Format tanggal
        $months = [
            'Januari' => '01', 'Februari' => '02', 'Maret' => '03', 'April' => '04',
            'Mei' => '05', 'Juni' => '06', 'Juli' => '07', 'Agustus' => '08',
            'September' => '09', 'Oktober' => '10', 'November' => '11', 'Desember' => '12'
        ];
        $month_num = $months[$request->month] ?? '01';
        $booking_date_str = $request->year . '-' . $month_num . '-' . str_pad($request->date, 2, '0', STR_PAD_LEFT);
        $booking_date = date('Y-m-d', strtotime($booking_date_str));
        $today = date('Y-m-d');

        if ($booking_date < $today) {
            return back()->with('error', 'Tanggal pemesanan tidak valid (tidak boleh kurang dari hari ini).');
        }

        // Konversi visit_type ke format database
        $visit_type = $request->type === 'personal' ? 'pribadi' : 'tur';

        // Simpan ke database
        $booking = Booking::create([
            'visitor_name' => $request->name,
            'visitor_email' => $request->email,
            'visitor_phone' => $request->phone,
            'booking_date' => $booking_date,
            'visit_type' => $visit_type,
            'ticket_quantity' => $quantity,
            'total_price' => $total,
            'is_free_guide' => $is_free_guide,
            'status' => 'pending',
        ]);

        // Simpan data ke session untuk halaman pembayaran berhasil
        session([
            'ticket_success' => [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'visit_date' => $request->date . ' ' . $request->month . ' ' . $request->year,
                'quantity' => $quantity,
                'type' => $request->type,
                'payment_method' => $request->payment_method,
                'ticket_price' => $ticket_price,
                'admin_fee' => $admin_fee,
                'guide_fee' => $guide_fee,
                'is_free_guide' => $is_free_guide,
                'total_ticket' => $total_ticket,
                'total' => $total,
            ]
        ]);

        return Redirect::route('pembayaran-pending', ['id' => $booking->id]);
    }

    public function showPending($id)
    {
        $booking = Booking::findOrFail($id);
        
        // If already paid, redirect to success
        if ($booking->status == 'lunas') {
            return Redirect::route('pembayaran-berhasil');
        }

        // If waiting for verification, we still show pending page but maybe with different UI state
        // The view handles logic based on status

        return view('pembayaran-pending', compact('booking'));
    }

    public function checkStatus($id)
    {
        $booking = Booking::findOrFail($id);
        return response()->json(['status' => $booking->status]);
    }

    public function cancel($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'expired']);

        return Redirect::to('/')->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function showConfirmation($id)
    {
        $booking = Booking::findOrFail($id);
        return view('konfirmasi-pembayaran', compact('booking'));
    }

    public function submitConfirmation(Request $request, $id)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $booking = Booking::findOrFail($id);

        if ($request->hasFile('payment_proof')) {
            $imageName = time().'.'.$request->payment_proof->extension();
            $request->payment_proof->move(public_path('payment_proofs'), $imageName);
            
            $booking->update([
                'payment_proof' => 'payment_proofs/'.$imageName,
                'status' => 'pending'
            ]);
        }

        // Prepare session data for success page
        $months = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April',
            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus',
            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        $date_parts = explode('-', $booking->booking_date);
        $formatted_date = $date_parts[2] . ' ' . $months[$date_parts[1]] . ' ' . $date_parts[0];

        $ticket_price = 5000;
        $admin_fee = 2500;
        $guide_fee = 0; // Assuming 0 as it wasn't saved in booking table explicitly, or could be recalculated
        $total_ticket = $booking->ticket_quantity * $ticket_price;

        session([
            'ticket_success' => [
                'id' => $booking->id, // Add ID for real-time status checking
                'name' => $booking->visitor_name,
                'phone' => $booking->visitor_phone,
                'email' => $booking->visitor_email,
                'visit_date' => $formatted_date,
                'quantity' => $booking->ticket_quantity,
                'type' => $booking->visit_type,
                'payment_method' => 'QRIS (Manual)',
                'ticket_price' => $ticket_price,
                'admin_fee' => $admin_fee,
                'guide_fee' => $guide_fee,
                'is_free_guide' => $booking->is_free_guide,
                'total_ticket' => $total_ticket,
                'total' => $booking->total_price,
                'status' => 'Pending', // Explicit status
            ]
        ]);

        return Redirect::route('pembayaran-berhasil');
    }
}

