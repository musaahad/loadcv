<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flpps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->string('nama_debitur');
            $table->string('no_rek');
            $table->unsignedBigInteger('bus_id');
            $table->unsignedBigInteger('developer_id');
            $table->integer('jumlah_objek');
            $table->date('tanggal_suratbu');
            $table->date('tanggal_terima');
            $table->date('tanggal_selesai')->nullable();
            $table->unsignedBigInteger('users_id');
            $table->string('status');
            $table->string('keterangan');

            $table->foreign('bus_id')->references('id')->on('bus')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('users_id')->references('id')->on('users')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE'); 
            $table->foreign('developer_id')->references('id')->on('developer')
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
        Schema::dropIfExists('flpps');
    }
}
