<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('section_id')->constrained('sections')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->string('video_url')->nullable();
            $table->integer('duration')->default(0); // in minutes
            $table->integer('order')->default(0);
            $table->boolean('is_free')->default(false);
            $table->enum('type', ['video', 'text', 'quiz', 'assignment'])->default('video');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
