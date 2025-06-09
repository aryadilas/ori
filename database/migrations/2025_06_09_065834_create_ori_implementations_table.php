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
        Schema::create('ori_implementations', function (Blueprint $table) {
            $table->id();
            $table->string('kode_fasyankes');
            $table->string('village_name');
            $table->string('child_name');
            $table->date('birthday');
            $table->enum('gender', ['L', 'P']);
            $table->string('child_nik');
            $table->string('parent_name');
            $table->string('parent_nik');
            $table->string('address');
            $table->string('telp');
            $table->enum('status', ['Hadir', 'Tidak Hadir']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ori_implementations');
    }
};
