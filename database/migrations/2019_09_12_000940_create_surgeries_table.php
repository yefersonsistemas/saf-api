<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurgeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surgeries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('type_surgery_id');
            $table->unsignedBigInteger('hospitalization_id');
            $table->unsignedBigInteger('classification_surgery_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('employe_id')
            ->references('id')
            ->on('employes')
            ->onDelete('CASCADE');

            $table->foreign('patient_id')
            ->references('id')
            ->on('patients')
            ->onDelete('CASCADE');

            $table->foreign('area_id')
            ->references('id')
            ->on('areas')
            ->onDelete('CASCADE');

            $table->foreign('type_surgery_id')
            ->references('id')
            ->on('type_surgeries')
            ->onDelete('CASCADE');

            $table->foreign('hospitalization_id')
            ->references('id')
            ->on('hospitalization')
            ->onDelete('CASCADE');

            $table->foreign('classification_surgery_id')
            ->references('id')
            ->on('classification_surgery')
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
        Schema::dropIfExists('surgeries');
    }
}
