<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ubications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('person_id')->unsigned();
            $table->integer('municipality_id')->unsigned();
            $table->integer('apple_tree_id')->unsigned();
            $table->text('streetName');
            $table->string('latitude');
            $table->string('length');
            $table->text('nameImage');
            $table->tinyInteger('state');
            $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
            $table->foreign('municipality_id')->references('id')->on('municipalities')->onDelete('cascade');
            $table->foreign('apple_tree_id')->references('id')->on('apple_trees')->onDelete('cascade');
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
        Schema::drop('ubications');
    }
}
