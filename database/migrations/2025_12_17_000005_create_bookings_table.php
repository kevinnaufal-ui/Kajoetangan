<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_name', 100);
            $table->string('visitor_email', 100);
            $table->string('visitor_phone', 20)->nullable();
            $table->date('booking_date');
            $table->enum('visit_type', ['pribadi', 'tur'])->default('pribadi');
            $table->integer('ticket_quantity');
            $table->decimal('total_price', 10, 2)->nullable();
            $table->boolean('is_free_guide')->default(false);
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
