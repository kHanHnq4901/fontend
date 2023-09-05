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
        Schema::create("junctiontable", function (Blueprint $table) {
        $table->increments('idJunction');

        $table->unsignedInteger('idAdditionalFees');
        $table->foreign('idAdditionalFees')->references('idAdditionalFees')->on('additinalfees');
        $table->unsignedInteger('idStudent');
        $table->foreign('idStudent')->references('idStudent')->on('student');
        $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop("junctiontable");
    }
};
