<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->string('history_number')->nullable();
            $table->string('name');
            $table->string('lastname');
            $table->unsignedInteger('dni')->unique();
            $table->enum('type_dni', ['V', 'E', 'J']);
            $table->enum('gender', ['Femenino', 'Masculino']);
            $table->string('phone');
            $table->string('email');
            $table->string('place');
            $table->date('birthdate');
            $table->unsignedInteger('age');
            $table->unsignedInteger('weight');
            $table->string('occupation');
            $table->string('profession');
            $table->string('address');
            $table->string('previous_surgery')->nullable();
            $table->unsignedBigInteger('doctor_id');
            $table->unsignedBigInteger('Branchoffice_id');
            $table->timestamps();
            
            $table->foreign('doctor_id')
                ->references('id')
                ->on('users')
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('patients');
        Schema::enableForeignKeyConstraints();
    }
}
