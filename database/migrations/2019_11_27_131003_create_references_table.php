<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('references', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('specialitie_id');
            $table->unsignedBigInteger('employe_id')->nullable();
            $table->string('doctor')->nullable();
            $table->string('reason')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')
            ->references('id')
            ->on('persons')
            ->onDelete('CASCADE');

            $table->foreign('specialitie_id')
            ->references('id')
            ->on('specialities')
            ->onDelete('CASCADE');

            $table->foreign('employe_id')
            ->references('id')
            ->on('employes')
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
        Schema::dropIfExists('references');
    }
}
