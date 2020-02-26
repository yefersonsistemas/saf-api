<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurgeryMedicinePharmacyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surgery_medicine_pharmacy', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('surgery_id');
            $table->unsignedBigInteger('medicine_pharmacy_id');
            $table->timestamps();

            $table->foreign('medicine_pharmacy_id')
            ->references('id')
            ->on('medicine_pharmacy')
            ->onDelete('CASCADE');
            
            $table->foreign('surgery_id')
            ->references('id')
            ->on('surgeries')
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
        Schema::dropIfExists('surgery_medicine_pharmacy');
    }
}
