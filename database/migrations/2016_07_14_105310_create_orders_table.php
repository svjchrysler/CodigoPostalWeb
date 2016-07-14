<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('client_id')->unsigned();
            $table->integer('ubication_id')->unsigned();
            $table->integer('business_id')->unsigned();
            $table->decimal('price', 5, 2);
            $table->date('orderDate');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('ubication_id')->references('id')->on('ubications')->onDelete('cascade');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade');
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
        Schema::drop('orders');
    }
}
