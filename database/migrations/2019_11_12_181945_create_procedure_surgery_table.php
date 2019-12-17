<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureSurgeryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_surgery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('typesurgery_id');
            $table->unsignedBigInteger('procedure_id');
            // $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('procedure_id')
            ->references('id')
            ->on('procedures')
            ->onDelete('CASCADE');
            
            $table->foreign('typesurgery_id')
            ->references('id')
            ->on('type_surgeries')
            ->onDelete('CASCADE');

            // $table->foreign('branch_id')
            // ->references('id')
            // ->on('branch')
            // ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procedure_surgery');
    }
}
