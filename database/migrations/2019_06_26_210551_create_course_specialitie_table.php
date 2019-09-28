<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSpecialitieTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_specialitie', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('specialitie_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
                ->onDelete('CASCADE');

            $table->foreign('specialitie_id')
                ->references('id')
                ->on('specialities')
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
        Schema::dropIfExists('course_specialitie');
    }
}
