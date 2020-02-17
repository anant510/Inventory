<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_outs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('stock_out_invoice_number')->default(1);
            $table->integer('stock_out_date');
            $table->integer('stock_out_category');
            $table->integer('stock_out_product');
            $table->integer('stock_out_actual_quantity');
            $table->integer('stock_out_quantity');
            $table->integer('stock_out_price');
            $table->integer('stock_out_discount');
            $table->integer('stock_out_total');

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
        Schema::dropIfExists('stock_outs');
    }
}
