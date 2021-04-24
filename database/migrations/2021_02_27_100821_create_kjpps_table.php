<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKjppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kjpps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('pimpinan')->nullable();
            $table->string('nomappi')->nullable();
            $table->string('ijinpublik')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kjpps');
    }
}
