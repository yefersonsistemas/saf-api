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
            $table->unsignedBigInteger('procedure_employe_id');
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('patient_id');
            $table->unsignedBigInteger('type_payment_id');
            $table->string('type_currency');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('procedure_employe_id')
            ->references('id')
            ->on('procedure_employe')
            ->onDelete('CASCADE');

            $table->foreign('person_id')
            ->references('id')
            ->on('persons')
            ->onDelete('CASCADE');

            $table->foreign('patient_id')
            ->references('id')
            ->on('patients')
            ->onDelete('CASCADE');

            $table->foreign('type_payment_id')
            ->references('id')
            ->on('type_payments')
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
        Schema::dropIfExists('billings');
    }
}
