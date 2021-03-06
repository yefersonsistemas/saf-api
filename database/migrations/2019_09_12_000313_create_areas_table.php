<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->enum('status', ['ocupado', 'desocupado'])->nullable();
            $table->unsignedBigInteger('type_area_id');
            $table->unsignedBigInteger('branch_id');
            $table->integer('number')->nullable();  //servira como contador en la creacion de consultorios
            $table->timestamps();

            $table->foreign('type_area_id')
            ->references('id')
            ->on('type_areas')
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
        Schema::dropIfExists('areas');
    }
}
