<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('name', ['cash', 'point_of_sale', 'transfer']);
            $table->unsignedBigInteger('Branchoffice_id');
            $table->timestamps();

            $table->foreign('Branchoffice_id')
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
        Schema::dropIfExists('type_payments');
    }
}
