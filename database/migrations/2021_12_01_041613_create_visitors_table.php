<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->date("periode");
            $table->integer("total")->default(0);
            $table->integer("mobile")->default(0);
            $table->integer("tablet")->default(0);
            $table->integer("desktop")->default(0);
            $table->integer("chrome")->default(0);
            $table->integer("firefox")->default(0);
            $table->integer("opera")->default(0);
            $table->integer("safari")->default(0);
            $table->integer("ie")->default(0);
            $table->integer("edge")->default(0);
            $table->integer("in_app")->default(0);
            $table->integer("windows")->default(0);
            $table->integer("linux")->default(0);
            $table->integer("mac")->default(0);
            $table->integer("android")->default(0);
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
        Schema::dropIfExists('visitors');
    }
}
