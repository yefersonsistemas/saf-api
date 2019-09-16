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
            $table->unsignedBigInteger('Type_Product_id');
            $table->unsignedBigInteger('Branchoffice_id');
            $table->timestamps();

            $table->foreign('Type_Product_id')
            ->references('id')
            ->on('type_products')
            ->onDelete('CASCADE');

            $table->foreign('Branchoffice_id')
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
        Schema::dropIfExists('inventories');
    }
}
