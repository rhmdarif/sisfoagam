<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriAkomodasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_akomodasi', function (Blueprint $table) {
            $table->id();
            $table->string("nama_kategori_akomodasi");
            $table->string("slug_kategori_akomodasi")->unique();
            $table->string("icon_kategori_akomodasi")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_akomodasi');
    }
}
