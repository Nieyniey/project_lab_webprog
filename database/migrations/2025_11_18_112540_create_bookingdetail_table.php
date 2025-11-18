<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookingdetail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('BookingID')->constrained('bookingheader')->onDelete('cascade');
            $table->foreignId('PropertyID')->constrained('properties')->onDelete('cascade');
            $table->Integer('GuestCount');
            $table->Integer('PricePerNight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookingdetail');
    }
};
