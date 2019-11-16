<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipmentSurgeryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_surgery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('equipment_id');
            $table->unsignedBigInteger('surgery_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('equipment_id')
            ->references('id')
            ->on('equipment')
            ->onDelete('CASCADE');

            
            $table->foreign('surgery_id')
            ->references('id')
            ->on('surgeries')
            ->onDelete('CASCADE');

            $table->foreign('branch_id')
            ->references('id')
            ->on('branch')
            ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_surgery');
    }
}
