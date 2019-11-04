<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaClassificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('area_classification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('classification_id');
            $table->timestamps();

            $table->foreign('area_id')
                ->references('id')
                ->on('areas')
                ->onDelete('CASCADE');

            $table->foreign('classification_id')
                ->references('id')
                ->on('classifications')
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
        Schema::dropIfExists('area_classification');
    }
}
