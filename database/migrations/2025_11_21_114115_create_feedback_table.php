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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->integer('roll');
            $table->integer('phone');
            $table->string('email')->nullable();
            $table->string('problem_type');
            $table->text('problem_details');
            $table->text('solution_proposal')->nullable();
            $table->boolean('is_anonymous')->default(true);
            $table->string('solution_status')->nullable()->default('Pending');
            $table->text('solution_from_admin')->nullable();
            $table->text('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
