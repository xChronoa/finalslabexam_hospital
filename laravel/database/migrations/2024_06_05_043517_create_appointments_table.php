<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            
            // Foreign Key "patient_id" referencing the table patient's id.
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')
                  ->references('id')->on('patients');

            // Foreign Key "doctor_id" referencing the table doctors's id.
            $table->unsignedBigInteger('doctor_id');
            $table->foreign('doctor_id')
                  ->references('id')->on('doctors');
                  
            $table->date('visit_date');
            $table->text('diagnosis');
            $table->text('treatment');
            $table->text('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
};
