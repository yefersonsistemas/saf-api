<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIcomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icome', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('billing_id');
            $table->string('total');
            $table->unsignedBigInteger('branchoffice_id');
            $table->timestamps();
           
            $table->foreign('billing_id')
                ->references('id')
                ->on('billings')
                ->onDelete('CASCADE');

            $table->foreign('branchoffice_id')
                ->references('id')
                ->on('branch_oficces')
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
        Schema::dropIfExists('icome');
    }
}
