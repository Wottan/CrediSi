<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabelShiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('label_shift', function (Blueprint $table) {
            $table->primary(['shift_id', 'label_id']);
            $table->foreignId('shift_id')->constrained('shifts')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('label_id')->constrained('labels')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('label_shift');
    }
}
