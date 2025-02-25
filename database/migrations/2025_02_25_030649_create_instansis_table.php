<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstansisTable extends Migration
{
    public function up()
    {
        Schema::create('instansis', function (Blueprint $table) {
            $table->id('id_instansi');
            $table->string('nama_instansi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('instansis');
    }
}