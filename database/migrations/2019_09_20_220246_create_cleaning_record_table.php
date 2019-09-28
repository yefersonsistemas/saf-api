<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCleaningRecordTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cleaning_record', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employe_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('type_cleaning_id');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('employe_id')
            ->references('id')
            ->on('employes')
            ->onDelete('CASCADE');

            $table->foreign('area_id')
            ->references('id')
            ->on('areas')
            ->onDelete('CASCADE');

            $table->foreign('type_cleaning_id')
            ->references('id')
            ->on('type_cleaning')
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
        Schema::dropIfExists('cleaning_record');
    }
}
