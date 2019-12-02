<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeMedicine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe_medicine', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('recipe_id');
            $table->unsignedBigInteger('medicine_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('recipe_id')
            ->references('id')
            ->on('recipe')
            ->onDelete('CASCADE');

            $table->foreign('medicine_id')
            ->references('id')
            ->on('medicines')
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
        Schema::dropIfExists('recipe_medicine');
    }
}
