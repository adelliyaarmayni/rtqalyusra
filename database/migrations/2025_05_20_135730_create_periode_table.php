<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('periode', function (Blueprint $table) {
            $table->id();
            $table->year('tahun_awal');
            $table->year('tahun_akhir');
            $table->string('tahun_ajaran')->unique(); 
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('periode');
    }
};
