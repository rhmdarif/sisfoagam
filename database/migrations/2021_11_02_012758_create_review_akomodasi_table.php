<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewAkomodasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_akomodasi', function (Blueprint $table) {
            $table->id();
            $table->integer("akomodasi_id");
            $table->integer("users_id");
            $table->string("tingkat_kepuasan");
            $table->text("komentar");
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
        Schema::dropIfExists('review_akomodasi');
    }
}
