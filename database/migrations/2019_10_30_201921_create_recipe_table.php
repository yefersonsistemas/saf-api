<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('medicine_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('patient_id')
            ->references('id')
            ->on('patients')
            ->onDelete('CASCADE');
            
            $table->foreign('employe_id')
            ->references('id')
            ->on('employes')
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
        Schema::dropIfExists('recipe');
    }
}
