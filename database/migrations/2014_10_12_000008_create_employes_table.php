<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('position_id');
            $table->unsignedBigInteger('branch_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('person_id')
                  ->references('id')
                  ->on('persons')
                  ->onDelete('CASCADE');

            $table->foreign('position_id')
                  ->references('id')
                  ->on('positions')
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
        Schema::dropIfExists('employes');
    }
}
