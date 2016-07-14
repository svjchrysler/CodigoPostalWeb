<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppleTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apple_trees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numberAppleTree');
            $table->integer('district');
            $table->string('codeGeo');
            $table->string('latitude');
            $table->string('length');            
            $table->string('codePostal');
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
        Schema::drop('apple_trees');
    }
}
