<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedure_billing', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('procedure_id');
            $table->unsignedBigInteger('billing_id');
            $table->timestamps();

            $table->foreign('procedure_id')
            ->references('id')
            ->on('procedures')
            ->onDelete('CASCADE');

            
            $table->foreign('billing_id')
            ->references('id')
            ->on('billings')
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
        Schema::dropIfExists('procedure_billing');
    }
}
