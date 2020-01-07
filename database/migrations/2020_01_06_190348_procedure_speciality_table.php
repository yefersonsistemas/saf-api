<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProcedureSpecialityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_speciality', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('procedure_id');
            $table->unsignedBigInteger('speciality_id');
            $table->timestamps();

            $table->foreign('speciality_id')
            ->references('id')
            ->on('specialities');
            
            $table->foreign('procedure_id')
            ->references('id')
            ->on('procedures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('procedure_speciality', function (Blueprint $table) {
            Schema::dropIfExists('procedure_speciality');
        });
    }
}
