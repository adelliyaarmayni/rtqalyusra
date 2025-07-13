<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dokumentasis', function (Blueprint $table) {
            $table->id();
            $table->string('dokumentasi');
            $table->unsignedBigInteger('jadwal_mengajar_id');
            $table->date('tanggal');
            $table->time('waktu_submit');       
            $table->time('batas_absen');        
            $table->string('status_terlambat');
            $table->timestamps();

            $table->foreign('jadwal_mengajar_id')->references('id')->on('jadwal_mengajar')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasis');
    }
};
