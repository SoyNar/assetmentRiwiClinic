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
        Schema::create('appointments_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id');
            $table->foreign('appointment_id')->references('id')->on('medical_appointments')->onDelete('cascade');
            $table->dateTime('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('appointments_history', function (Blueprint $table) {
            $table->dropForeign(['appointment_id']); // Elimina la clave foránea
        });

        Schema::dropIfExists('appointments_history'); // Elimina la tabla
    }
};
