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
        Schema::create('form2_answers', function (Blueprint $table) {
            $table->id();

            // $table->string('village_name');

            $table->string('kode_fasyankes');
            $table->year('year');

            
            $table->integer('house_id');
            $table->string('village_name');
            $table->string('parent_nik');
            $table->string('parent_name');
            $table->string('child_nik');
            $table->string('child_name');
            $table->date('birthdate');
            $table->enum('gender', ['l', 'p']);

            $table->enum('q1', ['y', 't', 'tt', 'n/a']);
            $table->enum('q2', ['y', 't', 'tt', 'n/a']);
            $table->enum('q3', ['y', 't', 'tt', 'n/a']);
            $table->enum('q4', ['y', 't', 'tt', 'n/a']);
            
            $table->text('q5')->nullable();
            $table->enum('q6', ['y', 't']);
            $table->text('q7');
            $table->enum('q8', ['y', 't']);
            $table->text('q9')->nullable();

            // parent_name
            // child_name
            // birthdate
            // gender
            // q1
            // q2
            // q3
            // q4
            // q5
            // q6
            // q7
            // q8
            // q9

            $table->timestamps();

            $table->foreign('kode_fasyankes')->references('kode_fasyankes')->on('fasyankes')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form2_answers');
    }
};
