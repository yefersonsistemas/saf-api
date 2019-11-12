<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->longText('description');
            $table->unsignedBigInteger('patient_id');
            $table->string('approved')->nullable();          //aprobado
            $table->string('reschedule')->nullable();          //reprogramar
            $table->string('cancel')->nullable();
            $table->string('discontinued')->nullable();      //suspendido
            $table->unsignedBigInteger('person_id');
            $table->string('status')->nullable();  //asistencia doctor
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('specialitie_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('patient_id')
            ->references('id')
            ->on('persons')
            ->onDelete('CASCADE');  

            $table->foreign('specialitie_id')
            ->references('id')
            ->on('specialities')
            ->onDelete('CASCADE');  

            $table->foreign('person_id')
            ->references('id')
            ->on('persons')
            ->onDelete('CASCADE');   
            
            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedules')
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
        Schema::dropIfExists('reservations');
    }
}
