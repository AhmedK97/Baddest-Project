<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorProjectPayed extends Migration
{

    // Doctor - > 1
    //             > operation(s) > paid(transactions)
    // Project - > Dental, Abdomnal, Head
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_project_payed', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_project_id');
            $table->integer('payed');
            $table->timestamps();

            $table->foreign('doctor_project_id')
                ->references('id')
                ->on('doctor_project')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doctor_project_payed');
    }
}
