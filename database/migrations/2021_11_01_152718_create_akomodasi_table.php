<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkomodasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akomodasi', function (Blueprint $table) {
            $table->id();
            $table->integer("kategori_akomodasi_id");
            $table->string("nama_akomodasi");
            $table->string("kelas")->nullable();
            $table->string("tipe")->nullable();
            $table->integer("harga");
            $table->text("keterangan")->nullable();
            $table->string("lat")->nullable();
            $table->string("long")->nullable();
            $table->string("slug_akomodasi")->unique();
            $table->string("thumbnail_akomodasi");
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
        Schema::dropIfExists('akomodasi');
    }
}
