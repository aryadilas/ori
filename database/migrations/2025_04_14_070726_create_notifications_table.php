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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('kode_fasyankes');
            $table->integer('total_case');
            $table->integer('start_week');
            $table->integer('end_week')->nullable();
            $table->enum('category', ['klb', 'lab']);
            $table->enum('status', ['confirmed', 'false']);
            $table->timestamps();

            $table->foreign('kode_fasyankes')->references('kode_fasyankes')->on('fasyankes')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
