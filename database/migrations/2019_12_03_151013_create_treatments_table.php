<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('measure'); //medida ml, gr
            $table->string('doses');  //dosis
            $table->string('duration');
            $table->string('indications');
            $table->unsignedBigInteger('medicine_id')->nullable();
            $table->unsignedBigInteger('recipe_id')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('medicine_id')
            ->references('id')
            ->on('medicines')
            ->onDelete('CASCADE');

            $table->foreign('recipe_id')
            ->references('id')
            ->on('recipe')
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
        Schema::dropIfExists('treatments');
    }
}
