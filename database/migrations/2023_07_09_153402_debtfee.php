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
        Schema::create("debtfee", function (Blueprint $table) {
            $table->increments("idDebtfee");

            $table->unsignedInteger('idStudent');
            $table->foreign('idStudent')->references('idStudent')->on('student');
            $table->unsignedInteger('idFee');
            $table->foreign('idFee')->references('idFee')->on('fee');
            $table->unsignedInteger('amount');
            $table->date('dueDate');
            $table->string('description');
            $table->string('status')->default('Đang chờ thanh toán');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop("debtfee");
    }
};
