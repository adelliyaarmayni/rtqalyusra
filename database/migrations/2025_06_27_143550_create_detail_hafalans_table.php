<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('detail_hafalans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('santri_id');
            $table->unsignedBigInteger('jadwal_mengajar_id');
            $table->date('tanggal');
            $table->string('juz')->nullable();
            $table->string('surah')->nullable();
            $table->string('ayat_awal')->nullable();
            $table->string('ayat_akhir')->nullable();
            $table->boolean('is_draft')->default(false); 
            $table->timestamps();

             $table->foreign('santri_id')->references('id')->on('santri');
            $table->foreign('jadwal_mengajar_id')->references('id')->on('jadwal_mengajar');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_hafalans');
    }
};
