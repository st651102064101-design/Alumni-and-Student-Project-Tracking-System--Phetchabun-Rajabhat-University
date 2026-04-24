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
            ->create('internships', function (Blueprint $table) {
            $table->id();
            $table->string('student_id', 20)->nullable(); // รหัสนักศึกษา
            $table->string('student_name')->nullable(); // ชื่อ-นามสกุลนักศึกษา
            $table->string('company_name'); // ชื่อสถานที่ฝึกงาน
            $table->text('company_address')->nullable(); // ที่อยู่สถานที่ฝึกงาน
            $table->string('job_role')->nullable(); // ตำแหน่ง/หน้าที่
            $table->date('start_date')->nullable(); // วันที่เริ่ม
            $table->date('end_date')->nullable(); // วันที่สิ้นสุด
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('in_progress');
            $table->string('academic_year', 4)->nullable(); // ปีการศึกษา
            $table->string('semester', 1)->nullable(); // ภาคเรียน
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection(env('PROJECTS_DB_CONNECTION', 'wordpress'))
            ->dropIfExists('internships');
    }
};
