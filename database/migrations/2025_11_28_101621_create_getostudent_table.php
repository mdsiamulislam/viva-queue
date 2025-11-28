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
        Schema::create('getostudent', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('batch')->nullable();
            $table->string('student_id')->unique(); // ID = unique
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->integer('total_male_guest')->default(0);
            $table->integer('total_female_guest')->default(0);
            $table->string('guest_name')->nullable();
            $table->string('floor_no')->nullable();
            $table->boolean('attendance')->default(false);
            $table->integer('guest_attend')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('getostudent');
    }
};
