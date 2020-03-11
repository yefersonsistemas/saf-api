<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActualizarLotPharmacyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actualizar_lot_pharmacy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('medicine_pharmacy_id');
            $table->string('number_lot');
            $table->string('date');
            $table->string('quantity_total');
            $table->string('date_vence');
            $table->unsignedBigInteger('branch_id');
            $table->timestamps();

            $table->foreign('medicine_pharmacy_id')
            ->references('id')
            ->on('medicine_pharmacy')
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
        Schema::dropIfExists('actualizar_lot_pharmacy');
    }
}
