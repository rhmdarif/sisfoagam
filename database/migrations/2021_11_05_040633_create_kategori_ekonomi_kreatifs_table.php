<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriEkonomiKreatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori_ekonomi_kreatif', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kategori_kreatif');
            $table->string('icon_kategori_kreatif');
            $table->string('slug_kategori_kreatif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori_ekonomi_kreatif');
    }
}
