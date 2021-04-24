<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKerjareviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerjareview', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('reviews_id');
            $table->date('tanggal_lengkap');
            $table->date('tanggal_inspeksi');
            $table->date('tanggal_penilaian');
            $table->string('peruntukan');
            $table->string('pendekatan');
            $table->string('legalitas');
            $table->string('no_sertifikat');
            $table->date('tanggal_terbit');
            $table->date('tanggal_berakhir');
            $table->string('no_tgl_gs');
            $table->string('atas_nama');
            $table->string('luas_tanah');
            $table->string('luas_bangunan')->nullable();
            $table->geometry('koordinat');
            $table->string('alamat');
            $table->string('province');
            $table->string('city');
            $table->string('districs');
            $table->string('villages');
            $table->integer('nilai_pasar');
            $table->integer('nilai_likuidasi');
            $table->string('keterangan')->nullable();

            $table->foreign('reviews_id')->references('id')->on('reviews')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kerjareview');
    }
}
