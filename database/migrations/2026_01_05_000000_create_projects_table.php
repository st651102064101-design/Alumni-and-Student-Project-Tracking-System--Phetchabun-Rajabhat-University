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
        Schema::connection(env('PROJECTS_DB_CONNECTION', 'wordpress'))
            ->create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_code', 20)->unique();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('category'); // Web, Mobile, AI, IoT, etc.
            $table->year('academic_year');
            $table->enum('semester', ['1', '2', '3']);
            $table->string('advisor')->nullable();
            $table->json('members')->nullable(); // รายชื่อสมาชิก
            $table->enum('status', ['proposal', 'in_progress', 'completed', 'cancelled'])->default('proposal');
            $table->string('document_url')->nullable();
            $table->string('repository_url')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('score')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(env('PROJECTS_DB_CONNECTION', 'wordpress'))
            ->dropIfExists('projects');
    }
};
