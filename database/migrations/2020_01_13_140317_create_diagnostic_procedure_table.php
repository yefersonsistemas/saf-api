<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticProcedureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostic_procedure', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('procedure_id');
            $table->unsignedBigInteger('diagnostic_id');
            $table->timestamps();

            $table->foreign('diagnostic_id')
            ->references('id')
            ->on('diagnostics')
            ->onDelete('CASCADE');

            
            $table->foreign('procedure_id')
            ->references('id')
            ->on('procedures')
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
        Schema::dropIfExists('diagnostic_procedure', function (Blueprint $table) {
            //
        });
    }
}
