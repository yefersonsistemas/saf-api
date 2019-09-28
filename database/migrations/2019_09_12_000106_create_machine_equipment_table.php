<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_equipment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->unsignedBigInteger('type_equipment_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('type_equipment_id')
                ->references('id')
                ->on('type_equipment')
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
        Schema::dropIfExists('machine_equipment');
    }
}
