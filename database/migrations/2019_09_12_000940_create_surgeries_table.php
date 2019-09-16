<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSurgeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surgeries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('Patient_id');
            $table->unsignedBigInteger('Area_id');
            $table->unsignedBigInteger('Type_Surgery_id');
            $table->unsignedBigInteger('Branchoffice_id');
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('CASCADE');

            $table->foreign('Patient_id')
            ->references('id')
            ->on('patients')
            ->onDelete('CASCADE');

            $table->foreign('Area_id')
            ->references('id')
            ->on('areas')
            ->onDelete('CASCADE');

            $table->foreign('Type_Surgery_id')
            ->references('id')
            ->on('typesurgeries')
            ->onDelete('CASCADE');

            $table->foreign('Branchoffice_id')
            ->references('id')
            ->on('branch_oficces')
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
        Schema::dropIfExists('surgeries');
    }
}
