<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_debitur');
            $table->string('cif')->nullable();
            $table->unsignedBigInteger('bus_id');
            $table->date('nosuratbu');
            $table->date('tanggal_suratbu');
            $table->date('tanggal_terima');
            $table->integer('jumlah_objek');
            $table->string('status')->nullable();
            $table->timestamps();
            $table->date('tanggal_selesai')->nullable();
            $table->unsignedBigInteger('users_id');
            $table->string('keterangan');

            $table->foreign('bus_id')->references('id')->on('bus')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table->foreign('users_id')->references('id')->on('users')
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
        Schema::dropIfExists('internal');
    }
}
