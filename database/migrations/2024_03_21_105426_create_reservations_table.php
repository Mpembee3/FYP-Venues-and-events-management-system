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
        //refresh required
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('venue_id')->constrained()->onDelete('cascade');
            $table->string('event_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['pending', 'approved', 'payment_required', 'withdrawn'])->default('pending');
            $table->timestamps();
            });

            Schema::table('reservations', function (Blueprint $table) {
                $table->enum('admin_approval', ['pending', 'approved', 'rejected'])->default('pending');
                $table->timestamp('admin_approved_at')->nullable();
                $table->enum('dvc_approval', ['pending', 'approved', 'rejected'])->default('pending');
                $table->timestamp('dvc_approved_at')->nullable();
                //$table->enum('pro_approval', ['pending', 'approved', 'rejected'])->default('pending');
                //$table->timestamp('pro_approved_at')->nullable();
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
