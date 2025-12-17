<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

        // Simpan ke database jika perlu
        // ...

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

        return Redirect::route('pembayaran-berhasil');
    }
}
