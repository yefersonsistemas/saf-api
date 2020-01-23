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
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->string('procedure_id')->nullable();  //posibles procedimientos
            $table->string('procedureR_id')->nullable(); //Procedimientos realizados
            $table->unsignedBigInteger('typesurgery_id')->nullable();
            $table->unsignedBigInteger('surgeryR_id')->nullable(); //Procedimientos realizados
            $table->string('exam_id')->nullable();
            $table->unsignedBigInteger('recipe_id')->nullable();
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('branch_id')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->string('status')->nullable();
            $table->unsignedBigInteger('report_medico_id')->nullable();
            $table->unsignedBigInteger('repose_id')->nullable();

            $table->timestamps();

            $table->foreign('patient_id')
            ->references('id')
            ->on('persons')
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

            $table->foreign('typesurgery_id')
            ->references('id')
            ->on('type_surgeries')
            ->onDelete('CASCADE');

            $table->foreign('surgeryR_id')
            ->references('id')
            ->on('type_surgeries')
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

            $table->foreign('report_medico_id')
            ->references('id')
            ->on('report_medicos')
            ->onDelete('CASCADE');

            $table->foreign('repose_id')
            ->references('id')
            ->on('reposes')
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
