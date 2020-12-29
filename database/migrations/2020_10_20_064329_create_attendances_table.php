<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('staff_id');
            $table->string('month');
            $table->string('attendance_code');
            $table->string('day_1',2)->nullable();
            $table->string('day_2',2)->nullable();
            $table->string('day_3',2)->nullable();
            $table->string('day_4',2)->nullable();
            $table->string('day_5',2)->nullable();
            $table->string('day_6',2)->nullable();
            $table->string('day_7',2)->nullable();
            $table->string('day_8',2)->nullable();
            $table->string('day_9',2)->nullable();
            $table->string('day_10',2)->nullable();
            $table->string('day_11',2)->nullable();
            $table->string('day_12',2)->nullable();
            $table->string('day_13',2)->nullable();
            $table->string('day_14',2)->nullable();
            $table->string('day_15',2)->nullable();
            $table->string('day_16',2)->nullable();
            $table->string('day_17',2)->nullable();
            $table->string('day_18',2)->nullable();
            $table->string('day_19',2)->nullable();
            $table->string('day_20',2)->nullable();
            $table->string('day_21',2)->nullable();
            $table->string('day_22',2)->nullable();
            $table->string('day_23',2)->nullable();
            $table->string('day_24',2)->nullable();
            $table->string('day_25',2)->nullable();
            $table->string('day_26',2)->nullable();
            $table->string('day_27',2)->nullable();
            $table->string('day_28',2)->nullable();
            $table->string('day_29',2)->nullable();
            $table->string('day_30',2)->nullable();
            $table->string('day_31',2)->nullable();
            $table->float('total_workday',3,1)->nullable();
            $table->timestamps();

            $table->unique('attendance_code');
            $table->unique(['month', 'staff_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
