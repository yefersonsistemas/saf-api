<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('person_id');
            $table->enum('type_visitor', ['Paciente', 'Visitante', 'Empleado']);
            $table->timestamp('inside')->nullable();
            $table->timestamp('outside')->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('person_id')
            ->references('id')
            ->on('persons')
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
        Schema::dropIfExists('visitors');
    }
}
