<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type_dni', ['N', 'E']);
            $table->string('dni');
            $table->string('name');
            $table->string('lastname');
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

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
        Schema::dropIfExists('persons');
    }
}
