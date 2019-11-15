<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationSurgeryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_surgery', function (Blueprint $table) {
            $table->bigIncrements('id');  //aqui se almacenara las reservas que son para cirugias
            $table->unsignedBigInteger('surgery_id');
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('surgery_id')
            ->references('id')
            ->on('surgeries')
            ->onDelete('CASCADE');

            $table->foreign('reservation_id')
            ->references('id')
            ->on('reservations')
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
        Schema::dropIfExists('reservation_surgery');
    }
}
