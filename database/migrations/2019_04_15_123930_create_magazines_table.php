<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagazinesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('magazines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('publisher_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('magazines', function ($table) {
            $table
                ->foreign('publisher_id')
                ->references('id')
                ->on('publishers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('magazines');
    }
}
