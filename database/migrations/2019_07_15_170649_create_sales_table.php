<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->double('paid_in_bs')->nullable();
            $table->double('usd_price')->nullable();
            $table->double('dollar_conversion')->nullable();
            $table->double('paid_in_usd')->nullable();
            $table->enum('payment_type', ['TRANSF', 'EFECTIVO', 'PUNTO V.']);
            $table->string('movement_number')->nullable();
            $table->string('receiving_bank')->nullable();
            $table->longText('observation')->nullable();
            $table->unsignedInteger('procedure_id');
            $table->unsignedInteger('assistant_id');
            $table->unsignedInteger('doctor_id');
            $table->unsignedInteger('patient_id');
            $table->unsignedBigInteger('Branchoffice_id');
            $table->timestamps();

            $table->foreign('Branchoffice_id')
                  ->references('id')
                  ->on('branch_oficces')
                  ->onDelete('CASCADE');

            // $table->foreign('doctor_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('CASCADE');

            // $table->foreign('assistant_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onDelete('CASCADE');

            // $table->foreign('patient_id')
            //     ->references('id')
            //     ->on('patients')
            //     ->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
