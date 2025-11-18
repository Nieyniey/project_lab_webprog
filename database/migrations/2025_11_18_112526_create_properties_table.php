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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('UserID')->constrained('users')->onDelete('cascade');
            $table->foreignId('CategoryID')->constrained('propertycategories')->onDelete('cascade');
            $table->string('Title', 100);
            $table->string('Description');
            $table->string('Photos');
            $table->string('Location', 50);
            $table->bigInteger('Price');
            $table->integer('IsAvailable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
