<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('length');
            $table->string('latitude');
            $table->unsignedBigInteger('headquarters_id');
            $table->timestamps();

            $table->foreign('headquarters_id')
                ->references('id')
                ->on('headquarters')
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
        Schema::dropIfExists('branch');
    }
}
