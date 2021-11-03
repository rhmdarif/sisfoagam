<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDestinasiWisataReviewWisatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('destinasi_wisata_review_wisata', function (Blueprint $table) {
            $table->id();
            $table->foreignId("destinasi_wisata_id");
            $table->foreignId("user_id");
            $table->integer("tingkat_kepuasan")->default(0);
            $table->text("komentar")->nullable();
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
        Schema::dropIfExists('destinasi_wisata_review_wisata');
    }
}
