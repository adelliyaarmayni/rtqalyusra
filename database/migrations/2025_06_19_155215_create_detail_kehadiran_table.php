<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('detail_kehadiran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(column: 'namasantri_id');
            $table->unsignedBigInteger('jadwal_mengajar_id');
            $table->date('tanggal');
            $table->string('status_kehadiran');
            $table->string('bukti')->nullable();
            $table->timestamps();

            $table->foreign('namasantri_id')->references('id')->on('santri');
            $table->foreign('jadwal_mengajar_id')->references('id')->on('jadwal_mengajar')->onDelete('cascade');
        });

        Schema::table('detail_kehadiran', function (Blueprint $table) {
            $table->string('bukti')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_kehadiran');
    }
};
