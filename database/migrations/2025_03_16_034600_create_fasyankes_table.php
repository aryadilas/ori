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
        Schema::create('fasyankes', function (Blueprint $table) {
            $table->id();
            $table->string('kode_fasyankes')->unique();
            $table->string('name');
            $table->string('type');
            $table->string('regency_id');
            $table->string('longitude');
            $table->string('latitude');
            $table->timestamps();

            $table->foreign('regency_id')->references('regency_id')->on('regencies')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fasyankes');
    }
};
