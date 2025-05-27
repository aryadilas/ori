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
        Schema::create('form3_answers', function (Blueprint $table) {
            $table->id();
            $table->string('kode_fasyankes');
            $table->year('year');
            
            $table->string('village_name');

            $table->string('age_group');
            $table->integer('suspect');
            $table->integer('population');

            $table->integer('vaccine_target')->nullable();
            $table->integer('coverage_target')->nullable();

            $table->timestamps();

            $table->foreign('kode_fasyankes')->references('kode_fasyankes')->on('fasyankes')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form3_answers');
    }
};
