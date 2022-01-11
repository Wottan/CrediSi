<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbonadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abonados', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->datetime('date_of_birth');
            $table->string('sex');
            $table->foreignId('province_id')->constrained('provinces');
            $table->date('start_date')->nullable();
            $table->string('email')->unique();
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
        Schema::dropIfExists('abonados');
    }
}
