<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistributionOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('distribution_order', function (Blueprint $table) {
            $table->primary(['distribution_id','order_id']);
            $table->integer('distribution_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->integer('employee_id')->unsigned();
            $table->foreign('distribution_id')->references('id')->on('distributions')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
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
        Schema::drop('distribution_order');
    }
}
