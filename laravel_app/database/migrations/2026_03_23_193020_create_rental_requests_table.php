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
        Schema::create('rental_requests', function (Blueprint $table) {
    $table->id();
    $table->text('text')->nullable();
    $table->enum('status', ['pending','accepted','rejected'])->default('pending');
    $table->unsignedBigInteger('sender_id');
    $table->unsignedBigInteger('receiver_id');
    $table->unsignedBigInteger('vehicle_id');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_requests');
    }
};
