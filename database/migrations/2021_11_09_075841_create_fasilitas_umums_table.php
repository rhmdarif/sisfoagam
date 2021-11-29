<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasilitasUmumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fasilitas_umum', function (Blueprint $table) {
            $table->id();
            $table->string("nama_fasilitas_umum");
            $table->string("slug_fasilitas_umum");
            $table->string('lat')->nullable();
            $table->string('long')->nullabe();
            $table->string('thumbnail');
            $table->text("keterangan");
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
        Schema::dropIfExists('fasilitas_umum');
    }
}
