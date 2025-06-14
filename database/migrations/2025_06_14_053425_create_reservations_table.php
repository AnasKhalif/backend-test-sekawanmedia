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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->foreignId('driver_id')->constrained()->onDelete('cascade');

            $table->unsignedBigInteger('approver_level1_id')->nullable();
            $table->unsignedBigInteger('approver_level2_id')->nullable();
            $table->enum('approval_level1_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('approval_level2_status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->date('reservation_date');
            $table->text('purpose')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
