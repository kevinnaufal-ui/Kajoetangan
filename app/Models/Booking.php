<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['visitor_name','visitor_email','visitor_phone','booking_date','visit_type','ticket_quantity','total_price','is_free_guide','status'];
}
