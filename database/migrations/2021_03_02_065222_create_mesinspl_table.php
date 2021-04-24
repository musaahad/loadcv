<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesinsplTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesinspl', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('kerjareview_id')->nullable();
            $table->unsignedBigInteger('kerjainternal_id')->nullable();
            $table->string('nama')->nullable();
            $table->string('spesifikasi')->nullable();
            $table->string('npm')->nullable();
            $table->string('nlm')->nullable();
            $table->string('catatan')->nullable();

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
        Schema::dropIfExists('mesinspl');
    }
}
