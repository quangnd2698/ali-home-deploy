<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('product_code',8);
            $table->string('product_name');
            $table->string('producer')->nullable();
            $table->string('product_type');
            $table->string('size')->nullable();
            $table->string('material')->nullable();
            $table->string('color')->nullable();
            $table->string('surface')->nullable();
            $table->string('uses_for')->nullable();
            $table->smallInteger('quantity_in_one_box')->nullable();
            $table->smallInteger('quantity')->nullable();
            $table->integer('import_price');
            $table->integer('sale_price');
            $table->string('type_code')->nullable();
            $table->integer('count_view')->nullable();
            // $table->integer('count_buy')->nullable();
            $table->integer('number_error')->nullable();
            $table->string('sale_on_web',8)->nullable();;
            $table->string('status',10);
            $table->text('description')->nullable();
            $table->string('combo')->nullable();
            $table->timestamps();

            $table->unique('product_code');
            $table->unique('product_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
