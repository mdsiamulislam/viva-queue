<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->unique();
            $table->string('zoom_link')->nullable();
            $table->date('start_date');
            $table->time('start_time');
            $table->integer('expected_duration_minutes')->default(5);
            $table->integer('avg_duration_seconds')->default(0);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('rooms');
    }
};
