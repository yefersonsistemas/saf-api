<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiseasePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disease_patient', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('disease_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('disease_id')
                ->references('id')
                ->on('diseases')
                ->onDelete('CASCADE');

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
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
        Schema::dropIfExists('disease_patient');
    }
}
