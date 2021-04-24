<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLegalitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanah', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('kerjareview_id')->nullable();
            $table->unsignedBigInteger('kerjainternal_id')->nullable();
            $table->string('jenis');
            $table->string('no_sertifikat');
            $table->date('tanggal_terbit');
            $table->date('tanggal_berakhir');
            $table->string('no_tgl_gs');
            $table->string('atas_nama');
            $table->integer('luas_tanah');
            $table->string('catatan');

            $table->foreign('kerjareview_id')->references('id')->on('kerjareview')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('kerjainternal_id')->references('id')->on('kerjainternal')
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
        Schema::dropIfExists('tanah');
    }
}
