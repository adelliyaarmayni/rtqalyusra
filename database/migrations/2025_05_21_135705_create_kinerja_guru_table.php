<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('kinerja_guru', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('nama_guru');
            $table->string('periode_id');
            $table->integer('jumlahTelat');
            $table->timestamps();
            
            $table->foreign('nama_guru')->references('nama_guru')->on('guru');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kinerja_guru');
    }
};
