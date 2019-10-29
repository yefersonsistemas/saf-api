<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity_Total');
            $table->integer('quantity_Available');
            $table->integer('quantity_Assigned');
            $table->unsignedBigInteger('supplie_id')->nullable();
            $table->unsignedBigInteger('equipment_id')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('supplie_id')
            ->references('id')
            ->on('supplies')
            ->onDelete('CASCADE');

            $table->foreign('equipment_id')
            ->references('id')
            ->on('equipment')
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
        Schema::dropIfExists('inventories');
    }
}
