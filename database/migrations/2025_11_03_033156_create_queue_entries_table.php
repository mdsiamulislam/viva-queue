<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('queue_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('room_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('status', ['waiting','in_progress','done','absent'])->default('waiting');
            $table->dateTime('joined_at')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('finished_at')->nullable();
            $table->integer('position')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('queue_entries');
    }
};
