<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("additinalfees", function (Blueprint $table) {
        $table->increments("idAdditionalFees");
        $table->string('nameAdditionalFees');
        $table->unsignedInteger('idMajor');
        $table->foreign('idMajor')->references('idMajor')->on('major');
        $table->unsignedInteger('idCourse');
        $table->foreign('idCourse')->references('idCourse')->on('course');
        $table->unsignedInteger('amount');
        $table->boolean('role');
        $table->date('dueDate');
        $table->integer('created_by_id')->nullable();
        $table->integer('updated_by_id')->nullable();
        $table->timestamps();
        $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop("additinnalfees");
    }
};
