<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('surgery_id');
            $table->unsignedBigInteger('procedure_id');
            $table->unsignedBigInteger('hospitalization_id');
            $table->unsignedBigInteger('equipment_id');  //para los equipos quirurgicos
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();
            
            $table->foreign('surgery_id')
            ->references('id')
            ->on('surgeries')
            ->onDelete('CASCADE');
            
            $table->foreign('employe_id')
            ->references('id')
            ->on('employes')
            ->onDelete('CASCADE');

            $table->foreign('procedure_id')
            ->references('id')
            ->on('procedures')
            ->onDelete('CASCADE');

            $table->foreign('hospitalization_id')
            ->references('id')
            ->on('hospitalization')
            ->onDelete('CASCADE');

            $table->foreign('equipment_id')
            ->references('id')
            ->on('equipment')
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
        Schema::dropIfExists('budget');
    }
}
