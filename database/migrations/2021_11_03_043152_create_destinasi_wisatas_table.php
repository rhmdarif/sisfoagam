<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinasiWisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinasi_wisata', function (Blueprint $table) {
            $table->id();
            $table->foreignId("kategori_wisata_id");
            $table->string("nama_wisata");
            $table->bigInteger("harga_tiket_dewasa")->default(0);
            $table->bigInteger("harga_tiket_anak")->default(0);
            $table->bigInteger("biaya_parkir_roda_2")->default(0);
            $table->bigInteger("biaya_parkir_roda_4")->default(0);
            $table->string("lat")->nullable();
            $table->string("long")->nullable();
            $table->string("slug_destinasi")->nullable();
            $table->string("keterangan")->nullable();
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
        Schema::dropIfExists('destinasi_wisata');
    }
}
