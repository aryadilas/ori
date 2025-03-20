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
        Schema::create('form1_answers', function (Blueprint $table) {
            $table->id();

            $table->string('kode_fasyankes');
            $table->string('village_name');
            $table->year('year');
            $table->enum('q1', ['y', 't']);
            $table->enum('q2', ['y', 't']);
            $table->integer('q3a');
            $table->integer('q3b');
            $table->integer('q4a');
            $table->integer('q4b');
            $table->integer('q5a');
            $table->integer('q5b');
            $table->integer('q6a');
            $table->integer('q6b');
            $table->timestamps();

            $table->foreign('kode_fasyankes')->references('kode_fasyankes')->on('fasyankes')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form1_answers');
    }
};
