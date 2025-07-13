<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('nama_guru')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('pend_akhir');
            $table->string('gol_dar');
            $table->string('mk');
            $table->string('bagian');
            $table->string('cabang');   
            $table->string('alamat');
            $table->string('no_hp');
            $table->string('email');
            $table->enum('status_menikah', ['Menikah', 'Belum Menikah']);
            $table->integer('jlh_hafalan');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('guru');
    }
};
