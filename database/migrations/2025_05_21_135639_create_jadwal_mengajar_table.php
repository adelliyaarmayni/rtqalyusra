<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('jadwal_mengajar', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guru_id');
            $table->string('kelas');
            $table->string('cabang');
            $table->string('kegiatan');
            $table->unsignedBigInteger('periode_id');
            $table->time('jam_masuk');
            $table->time('jam_keluar');
            $table->timestamps();

            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('cascade');
            $table->foreign('periode_id')->references('id')->on('periode')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwal_mengajar');
    }
};
