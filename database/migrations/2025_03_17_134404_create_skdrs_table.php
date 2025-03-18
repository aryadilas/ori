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
        Schema::create('skdrs', function (Blueprint $table) {
            $table->id();
            $table->string('officer_name');
            $table->integer('week');
            $table->year('year');
            $table->integer('case_count');
            $table->text('patient_names');
            $table->string('kode_fasyankes');
            $table->timestamps();

            $table->foreign('kode_fasyankes')->references('kode_fasyankes')->on('fasyankes')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skdrs');
    }
};
