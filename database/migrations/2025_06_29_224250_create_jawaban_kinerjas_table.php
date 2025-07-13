<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('jawaban_kinerjas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kinerja_id');
            $table->unsignedBigInteger('kategori_id');
            $table->string('jawaban');
            $table->timestamps();

            $table->foreign('kinerja_id')->references('id')->on('kinerja_guru');
            $table->foreign('kategori_id')->references('id')->on('kategori');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jawaban_kinerjas');
    }
};
