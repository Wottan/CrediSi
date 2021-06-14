<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoreUserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->date('admission_date')->nullable();
            $table->integer('vacation_days')->nullable();  
        });

        Schema::create('timeoff', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->datetime('start');
            $table->datetime('end');
            $table->string('type');
            $table->string('justification')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('admission_date');
            $table->dropColumn('vacation_days');
        });

        Schema::dropIfExists('timeoff');
    }
}
