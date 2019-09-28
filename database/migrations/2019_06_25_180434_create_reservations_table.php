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
            $table->enum('status', ['aprobado', 'pendiente', 'cancelado']);
            $table->unsignedBigInteger('schedule_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();
            
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
