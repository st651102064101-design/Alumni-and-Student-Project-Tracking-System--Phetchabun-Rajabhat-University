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
        Schema::create('alumni', function (Blueprint $table) {
            $table->id();
            $table->string('student_code', 20)->unique(); // รหัสนักศึกษา
            $table->string('prefix', 20)->nullable(); // คำนำหน้า
            $table->string('first_name'); // ชื่อ
            $table->string('last_name'); // นามสกุล
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->year('graduation_year'); // ปีที่จบการศึกษา
            $table->string('degree')->default('ปริญญาตรี'); // วุฒิการศึกษา
            $table->string('major')->nullable(); // สาขาวิชา
            $table->decimal('gpa', 3, 2)->nullable(); // เกรดเฉลี่ย
            $table->string('current_workplace')->nullable(); // ที่ทำงานปัจจุบัน
            $table->string('current_position')->nullable(); // ตำแหน่งงาน
            $table->string('job_type')->nullable(); // ประเภทงาน (ตรงสาขา/ไม่ตรงสาขา/ศึกษาต่อ/อื่นๆ)
            $table->decimal('salary', 12, 2)->nullable(); // เงินเดือน
            $table->text('address')->nullable(); // ที่อยู่
            $table->string('province')->nullable(); // จังหวัด
            $table->string('facebook')->nullable(); // Facebook
            $table->string('line_id')->nullable(); // Line ID
            $table->string('profile_image')->nullable(); // รูปโปรไฟล์
            $table->enum('status', ['employed', 'unemployed', 'self_employed', 'further_study', 'other'])->default('employed');
            $table->text('notes')->nullable(); // หมายเหตุ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumni');
    }
};
