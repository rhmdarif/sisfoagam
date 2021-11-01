<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkomodasiFasilitasAkomodasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akomodasi_fasilitas_akomodasi', function (Blueprint $table) {
            $table->id();
            $table->integer("id_akomodasi");
            $table->integer("id_fasilitas_akomodasi");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('akomodasi_fasilitas_akomodasi');
    }
}
