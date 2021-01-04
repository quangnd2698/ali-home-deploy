<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_code');
            $table->string('staff_sale');
            $table->string('introduce_staff')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_phone');
            $table->integer('total_cost');
            $table->string('preferential')->nullable();
            $table->integer('last_cost');
            $table->string('sales_channel')->nullable();
            $table->timestamps();

            $table->unique('invoice_code');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
