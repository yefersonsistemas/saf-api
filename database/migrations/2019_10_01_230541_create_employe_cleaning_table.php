<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeCleaningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employe_cleaning', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('type_cleaning_id');
            $table->timestamps();

            $table->foreign('employe_id')
                ->references('id')
                ->on('employes')
                ->onDelete('CASCADE');

            $table->foreign('type_cleaning_id')
                ->references('id')
                ->on('type_cleaning')
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
        Schema::dropIfExists('employe_cleaning');
    }
}
