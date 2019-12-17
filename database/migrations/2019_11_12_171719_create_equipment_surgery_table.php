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
            $table->unsignedBigInteger('typesurgery_id');
            $table->timestamps();

            $table->foreign('equipment_id')
            ->references('id')
            ->on('equipment')
            ->onDelete('CASCADE');

            
            $table->foreign('typesurgery_id')
            ->references('id')
            ->on('type_surgeries')
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
