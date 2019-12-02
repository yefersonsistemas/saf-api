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
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('doctor_id'); // precio de la consulta
            $table->string('procedure_id')->nullable();
            $table->unsignedBigInteger('surgery_id')->nullable();
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('recipe_id');
            $table->unsignedBigInteger('reservation_id');
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
