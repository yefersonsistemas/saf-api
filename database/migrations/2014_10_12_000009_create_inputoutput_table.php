<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputoutputTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputoutput', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id');
            $table->string('inside')->nullable();
            $table->string('inside_office')->nullable();
            $table->string('outside')->nullable();
            $table->string('outside_office')->nullable();
            $table->boolean('activo')->nullable();
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('person_id')
            ->references('id')
            ->on('persons')
            ->onDelete('CASCADE');   

            $table->foreign('employe_id')
            ->references('id')
            ->on('employes')
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
        Schema::dropIfExists('inputoutput');
    }
}
