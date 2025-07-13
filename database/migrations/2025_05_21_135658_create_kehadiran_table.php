<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('kehadiran', function (Blueprint $table) {
            $table->id();
            $table->string('nama_guru');
            $table->string('kelas');
            $table->string('cabang');
            $table->string('kegiatan_santri');
            $table->date('hari_tanggal');
            $table->time('waktu');
            $table->unsignedBigInteger('periode_id'); 
            $table->timestamps();

            // Foreign key
            $table->foreign('nama_guru')->references('nama_guru')->on('guru');
            $table->foreign('periode_id')->references('id')->on('periode');
        });
    }

    public function down() {
        Schema::dropIfExists('kehadiran');
    }
};