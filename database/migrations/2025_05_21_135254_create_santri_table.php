<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('nis');
            $table->string('nama_santri')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('GolDar');
            $table->string('MK');
            $table->string('email');
            $table->string('NoHP_ortu');
            $table->string('asal_sekolah');
            $table->string('pekerjaan_ortu');
            $table->string('nama_ortu');
            $table->string('kat_masuk');
            $table->string('asal');
            $table->string('kelas');
            $table->unsignedBigInteger('periode_id');
            $table->string('jenis_kelas');
            $table->string('cabang');
            $table->timestamps();

            $table->foreign('periode_id')->references('id')->on('periode')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('santri', function (Blueprint $table) {
            $table->dropForeign(['periode_id']);
            $table->dropColumn('periode_id');
        });
    }
};
