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
        Schema::table('medical_appointments', function (Blueprint $table) {
            $table->string('symptoms')->nullable();
            $table->string('medications')->nullable();
            $table->string('treatment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_appointments', function (Blueprint $table) {
            //
        });
    }
};
