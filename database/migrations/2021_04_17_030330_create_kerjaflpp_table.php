<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKerjaflppTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerjaflpp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('flpps_id');
            $table->date('tanggal_inspeksi')->nullable();
            $table->string('legalitas')->nullable();
            $table->string('no_sertifikat')->nullable();
            $table->date('tanggal_terbit')->nullable();
            $table->date('tanggal_berakhir')->nullable();
            $table->string('no_tgl_gs')->nullable();
            $table->string('atas_nama')->nullable();
            $table->string('no_imb')->nullable();
            $table->date('tanggal_imb')->nullable();
            $table->string('kondisi_jalan')->nullable();
            $table->string('kondisi_drainase')->nullable();
            $table->string('listrik')->nullable();
            $table->string('air')->nullable();
            $table->string('luas_tanah')->nullable();
            $table->string('luas_bangunan')->nullable();
            $table->string('koordinat')->nullable();
            $table->string('keterangan')->nullable();

            $table->foreign('flpps_id')->references('id')->on('flpps')
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
        Schema::dropIfExists('kerjaflpp');
    }
}
