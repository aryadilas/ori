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
        Schema::create('subdistricts', function (Blueprint $table) {
            $table->id();
            $table->string('subdistrict_id')->unique();
            $table->string('province_id');
            $table->string('regency_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('province_id')->references('province_id')->on('provinces')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('regency_id')->references('regency_id')->on('regencies')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subdistricts');
    }
};
