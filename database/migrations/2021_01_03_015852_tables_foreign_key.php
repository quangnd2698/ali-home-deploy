<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablesForeignKey extends Migration
{
    // /**
    //  * Run the migrations.
    //  *
    //  * @return void
    //  */
    // public function up()
    // {
    //     Schema::table('products', function (Blueprint $table) {
    //         $table->foreign('producer')->references('brand_name')->on('brands');
    //     });

    //     Schema::table('orders', function (Blueprint $table) {
    //         $table->foreign('customer_phone')->references('phone')->on('users');
    //     });

    //     Schema::table('order_details', function (Blueprint $table) {
    //         $table->foreign('order_id')->references('id')->on('orders');
    //         $table->foreign('product_code')->references('product_code')->on('products');
    //     });

    //     Schema::table('accumulate_points', function (Blueprint $table) {
    //         $table->foreign('customer_phone')->references('phone')->on('users');
    //     });

    //     Schema::table('carts', function (Blueprint $table) {
    //         $table->foreign('user_id')->references('id')->on('users');
    //         $table->foreign('product_id')->references('id')->on('products');
    //     });

    //     Schema::table('invoices', function (Blueprint $table) {
    //         $table->foreign('customer_phone')->references('phone')->on('users');
    //     });

    //     Schema::table('invoice_details', function (Blueprint $table) {
    //         $table->foreign('invoice_code')->references('invoice_code')->on('invoices');
    //         $table->foreign('product_code')->references('product_code')->on('products');
    //     });

    //     Schema::table('salary_details', function (Blueprint $table) {
    //         $table->foreign('salary_code')->references('salary_code')->on('salaries');
    //         $table->foreign('admin_id')->references('id')->on('admins');
    //     });

    //     Schema::table('attendances', function (Blueprint $table) {
    //         $table->foreign('staff_id')->references('id')->on('admins');
    //     });

    //     Schema::table('payrolls', function (Blueprint $table) {
    //         $table->foreign('staff_id')->references('id')->on('admins');
    //     });

    //     Schema::table('import_invoice_details', function (Blueprint $table) {
    //         $table->foreign('invoice_code')->references('invoice_code')->on('import_invoices');
    //         $table->foreign('product_code')->references('product_code')->on('products');
    //     });

    //     Schema::table('images', function (Blueprint $table) {
    //         $table->foreign('product_code')->references('product_code')->on('products');
    //     });

    //     Schema::table('comments', function (Blueprint $table) {
    //         $table->foreign('user_id')->references('id')->on('users');
    //         $table->foreign('product_id')->references('id')->on('products');
    //     });
    // }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
