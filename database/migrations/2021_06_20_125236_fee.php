<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Fee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee', function (Blueprint $table) {
            $table->increments("idFee");
            $table->unsignedInteger('idMajor');
            $table->foreign('idMajor')->references('idMajor')->on('major');
            $table->unsignedInteger('idCourse');
            $table->foreign('idCourse')->references('idCourse')->on('course');
            $table->unsignedInteger('fee');
            $table->date('startDate');
            $table->date('endDate');
            $table->integer('created_by_id')->nullable();
            $table->integer('updated_by_id')->nullable();
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
        Schema::drop('fee');
    }
}
