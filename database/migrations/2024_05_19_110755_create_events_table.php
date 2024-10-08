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
        
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('venue_id');
            $table->unsignedBigInteger('payment_id');
            // $table->string('event_id');
            // $table->date('reservation_date');
            // $table->time('start_time');
            // $table->time('end_time');
            $table->enum('status',['upcoming', 'completed', 'ongoing'])->default('upcoming'); // Adding status field
            $table->timestamps();
    
            // Foreign key constraints
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
