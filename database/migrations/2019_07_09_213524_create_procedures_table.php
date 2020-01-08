<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProceduresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->double('price')->nullable();
            // $table->unsignedBigInteger('speciality_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            // $table->foreign('speciality_id')
            //       ->references('id')
            //       ->on('specialities')
            //       ->onDelete('CASCADE');

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('procedures');
        Schema::enableForeignKeyConstraints();
    }
}
