<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddThumbnailDestinasiWisataToDestinasiWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('destinasi_wisata', function (Blueprint $table) {
            //
            $table->string("thumbnail_destinasi_wisata")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('destinasi_wisata', function (Blueprint $table) {
            //
            $table->dropColumn(['thumbnail_destinasi_wisata']);
        });
    }
}
