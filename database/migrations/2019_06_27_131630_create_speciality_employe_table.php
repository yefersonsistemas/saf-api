<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialityEmployeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speciality_employe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('speciality_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('employe_id')
                ->references('id')
                ->on('employes')
                ->onDelete('CASCADE');

            $table->foreign('speciality_id')
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
        Schema::dropIfExists('speciality_user');
    }
}
