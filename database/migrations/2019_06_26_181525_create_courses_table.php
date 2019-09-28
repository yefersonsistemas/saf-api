<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description');
            $table->unsignedBigInteger('specialitie_id');
            $table->unsignedBigInteger('program_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('specialitie_id')
            ->references('id')
            ->on('specialities');

            $table->foreign('program_id')
            ->references('id')
            ->on('programs');

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
        Schema::dropIfExists('courses');
    }
}
