<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_details', function (Blueprint $table) {
            $table->id();
            $table->string('salary_code',15);
            $table->unsignedBigInteger('admin_id');
            $table->string('staff_name');
            $table->integer('basic_salary');
            $table->smallInteger('salary_type')->nullable();
            $table->integer('commission')->nullable();
            $table->integer('allowance')->nullable();
            $table->smallInteger('workdays');
            $table->integer('amercement')->nullable();
            $table->integer('advance_money')->nullable();
            $table->integer('insurrance');
            $table->integer('last_salary');
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
        Schema::dropIfExists('salary_details');
    }
}
