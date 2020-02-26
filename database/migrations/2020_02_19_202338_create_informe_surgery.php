<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformeSurgery extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informe_surgery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('surgery_id');
            $table->boolean('status');
            $table->date('fecha_ingreso');
            $table->date('fecha_culminar');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

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
        Schema::dropIfExists('informe_surgery');
    }
}
