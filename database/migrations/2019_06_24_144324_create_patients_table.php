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
            $table->string('history_number');
            $table->string('reason')->nullable()->nullable();
            $table->unsignedBigInteger('person_id');
            $table->enum('gender', ['Femenino', 'Masculino'])->nullable();
            $table->string('place')->nullable();
            $table->date('birthdate')->nullable();
            $table->unsignedInteger('age')->nullable();
            $table->unsignedInteger('weight')->nullable();
            $table->string('occupation')->nullable();
            $table->string('profession')->nullable();
            $table->string('previous_surgery')->nullable();
            $table->unsignedBigInteger('employe_id');
            $table->string('another_phone')->nullable();
            $table->string('another_email')->nullable();
            $table->string('social_network')->nullable();
            $table->string('about_us')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();
            
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('patients');
        Schema::enableForeignKeyConstraints();
    }
}
