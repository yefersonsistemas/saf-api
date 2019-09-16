<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('process');
            $table->string('dni');
            $table->string('name');
            $table->string('lastname');
            $table->string('address');
            $table->string('phone');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('Patient_id');
            $table->unsignedBigInteger('Type_Payment_id');
            $table->unsignedBigInteger('Type_Currency_id');
            $table->unsignedBigInteger('Branchoffice_id');
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('CASCADE');

            $table->foreign('Patient_id')
            ->references('id')
            ->on('patients')
            ->onDelete('CASCADE');

            $table->foreign('Type_Payment_id')
            ->references('id')
            ->on('type_payments')
            ->onDelete('CASCADE');

            $table->foreign('Type_Currency_id')
            ->references('id')
            ->on('type_currencies')
            ->onDelete('CASCADE');

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
        Schema::dropIfExists('billings');
    }
}
