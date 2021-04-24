<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatapasarTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datapasar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('kerjainternal_id')->nullable();
            $table->unsignedBigInteger('kerjareview_id')->nullable();
            $table->date('tanggal_data')->nullable();
            $table->string('peruntukan')->nullable();
            $table->string('penjual')->nullable();
            $table->string('notelp')->nullable();
            $table->string('legalitas')->nullable();
            $table->string('luas_tanah')->nullable();
            $table->string('luas_bangunan')->nullable();
            $table->geometry('koordinat')->nullable();
            $table->string('alamat')->nullable();
            $table->integer('harga_penawaran')->nullable();
            $table->string('keterangan')->nullable();

            $table->foreign('kerjainternal_id')->references('id')->on('kerjainternal')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('kerjareview_id')->references('id')->on('kerjareview')
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
        Schema::dropIfExists('datapasar');
    }
}
