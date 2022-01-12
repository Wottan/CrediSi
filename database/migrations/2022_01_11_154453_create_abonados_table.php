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
            $table->string('dni')->unique();
            $table->string('name')->nullable();;
            $table->string('last_name')->nullable();;
            $table->date('date_of_birth')->nullable();;
            $table->string('sex')->nullable();;
            $table->foreignId('province_id')->constrained('provinces')->nullable();
            $table->date('start_date')->nullable();
            $table->string('email')->unique()->nullable();
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
