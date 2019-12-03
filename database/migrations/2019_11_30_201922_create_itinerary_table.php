<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItineraryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itinerary', function (Blueprint $table) {
            $table->bigIncrements('id');
<<<<<<< HEAD:database/migrations/2019_10_30_201922_create_itinerary_table.php
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('doctor_id'); // precio de la consulta
            $table->string('procedure_id')->nullable();
            $table->unsignedBigInteger('surgery_id')->nullable();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('recipe_id');
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('branch_id');
=======
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->unsignedBigInteger('employe_id')->nullable();
            $table->json('procedure_id')->nullable();
            $table->unsignedBigInteger('surgery_id')->nullable();
            $table->unsignedBigInteger('exam_id')->nullable();
            $table->unsignedBigInteger('recipe_id')->nullable();
            $table->unsignedBigInteger('reservation_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->unsignedBigInteger('diagnostic_id')->nullable();

>>>>>>> 54afa414b2c56755cf68d3f03b2dee0dfc2ec017:database/migrations/2019_11_30_201922_create_itinerary_table.php
            $table->timestamps();

            $table->foreign('patient_id')
            ->references('id')
            ->on('patients')
            ->onDelete('CASCADE');

            $table->foreign('employe_id')
            ->references('id')
            ->on('employes')
            ->onDelete('CASCADE');

            $table->foreign('doctor_id')
            ->references('id')
            ->on('doctors')
            ->onDelete('CASCADE');

            $table->foreign('reservation_id')
            ->references('id')
            ->on('reservations')
            ->onDelete('CASCADE');

            
            $table->foreign('surgery_id')
            ->references('id')
            ->on('surgeries')
            ->onDelete('CASCADE');
            
            $table->foreign('exam_id')
            ->references('id')
            ->on('exams')
            ->onDelete('CASCADE');

            
            $table->foreign('recipe_id')
            ->references('id')
            ->on('recipe')
            ->onDelete('CASCADE');

            $table->foreign('branch_id')
            ->references('id')
            ->on('branch')
            ->onDelete('CASCADE');

            $table->foreign('reference_id')
            ->references('id')
            ->on('references')
            ->onDelete('CASCADE');

            $table->foreign('diagnostic_id')
            ->references('id')
            ->on('diagnostics')
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
        Schema::dropIfExists('itinerary');
    }
}
