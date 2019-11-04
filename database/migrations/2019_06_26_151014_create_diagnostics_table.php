<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('patient_id');
            $table->longText('description')->nullable();
            $table->longText('reason')->nullable();
            $table->unsignedBigInteger('treatment_id');
            $table->longText('indications')->nullable();
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('patient_id')
                ->references('id')
                ->on('patients')
                ->onDelete('CASCADE');

            $table->foreign('treatment_id')
                ->references('id')
                ->on('treatments')
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
        Schema::dropIfExists('diagnostics');
    }
}
