<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostic_exam', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('diagnostic_id');
            $table->unsignedBigInteger('exam_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();
            
            $table->foreign('diagnostic_id')
                ->references('id')
                ->on('diagnostics')
                ->onDelete('CASCADE');

            $table->foreign('exam_id')
                ->references('id')
                ->on('exams')
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
        Schema::dropIfExists('diagnostic_exam');
    }
}
