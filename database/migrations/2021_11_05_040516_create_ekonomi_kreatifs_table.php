<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEkonomiKreatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekonomi_kreatif', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_ekonomi_kreatif_id');
            $table->string('nama_ekonomi_kreatif');
            $table->bigInteger('harga');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('slug_ekonomi_kreatif');
            $table->string('thumbnail_ekonomi_kreatif');
            $table->text('keterangan');
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
        Schema::dropIfExists('ekonomi_kreatif');
    }
}
