<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('employe_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            $table->foreign('course_id')
                ->references('id')
                ->on('courses')
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
        Schema::dropIfExists('interests');
    }
}
