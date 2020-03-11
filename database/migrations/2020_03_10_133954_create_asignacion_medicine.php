<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignacionMedicine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignacion_medicine', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('lot_pharmacy_id');
            $table->unsignedBigInteger('surgery_id');
            $table->integer('cantidad');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('lot_pharmacy_id')
            ->references('id')
            ->on('lot_pharmacy')
            ->onDelete('CASCADE');

            $table->foreign('surgery_id')
            ->references('id')
            ->on('surgeries')
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
        Schema::dropIfExists('asignacion_medicine');
    }
}
