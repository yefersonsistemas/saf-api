<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesurgeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_surgeries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('duration');
            $table->double('cost');
            $table->longText('description');
            $table->unsignedBigInteger('classification_surgery_id');
            $table->unsignedBigInteger('employe_id');
            $table->string('day_hospitalization');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('classification_surgery_id')
            ->references('id')
            ->on('classification_surgery')
            ->onDelete('CASCADE');

            $table->foreign('branch_id')
                    ->references('id')
                    ->on('branch')
                    ->onDelete('CASCADE');

            $table->foreign('employe_id')
            ->references('id')
            ->on('employes')
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
        Schema::dropIfExists('typesurgeries');
    }
}
