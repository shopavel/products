<?php

use Shopavel\Products\Price;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Create product price table migration.
 *
 * @author Laurence Roberts <lsjroberts@outlook.com>
 */
class CreateProductPriceTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(with(new Price)->getTable(), function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('currency_id')->nullable();
            $table->integer('name');
            $table->integer('price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(with(new Price)->getTable());
    }

}
