<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity_Assigned');
            $table->integer('quantity_Used');
            $table->integer('quantity_Available');
            $table->unsignedBigInteger('type_area_id');
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('branchoffice_id');
            $table->timestamps();

            $table->foreign('type_area_id')
                ->references('id')
                ->on('type_areas')
                ->onDelete('CASCADE');

            $table->foreign('inventory_id')
                ->references('id')
                ->on('inventories')
                ->onDelete('CASCADE');

            $table->foreign('branchoffice_id')
                  ->references('id')
                  ->on('branch_oficces')
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
        Schema::dropIfExists('inventory_areas');
    }
}
