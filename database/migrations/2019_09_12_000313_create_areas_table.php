<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('Type_Area_id');
            $table->unsignedBigInteger('Branchoffice_id');
            $table->timestamps();

            $table->foreign('Type_Area_id')
            ->references('id')
            ->on('type_areas')
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
        Schema::dropIfExists('areas');
    }
}
