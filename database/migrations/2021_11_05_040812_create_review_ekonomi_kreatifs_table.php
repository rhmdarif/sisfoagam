<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewEkonomiKreatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_ekonomi_kreatif', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ekonomi_kreatif_id');
            $table->foreignId('user_id');
            $table->integer('tingkat_kepuasan');
            $table->text('komentar');
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
        Schema::dropIfExists('review_ekonomi_kreatif');
    }
}
