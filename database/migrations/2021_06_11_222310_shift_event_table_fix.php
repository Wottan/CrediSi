<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ShiftEventTableFix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('shifts');
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('user_id');
            $table->date('start');
            $table->string('type');
            $table->string('recurrence');
            $table->timestamps();
        });

        Schema::dropIfExists('shift_events');
        Schema::create('shift_events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('shift_id');
            $table->datetime('start');
            $table->datetime('end');
            $table->string('color');
            $table->boolean('timed');
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
        Schema::dropIfExists('shift_events');
        Schema::dropIfExists('shifts');
    }
}
