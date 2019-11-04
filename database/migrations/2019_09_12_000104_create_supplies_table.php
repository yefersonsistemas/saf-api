<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('presentation');
            $table->unsignedBigInteger('type_supplie_id');
            $table->integer('quantity');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('type_supplie_id')
            ->references('id')
            ->on('type_supplies')
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
        Schema::dropIfExists('supplies');
    }
}
