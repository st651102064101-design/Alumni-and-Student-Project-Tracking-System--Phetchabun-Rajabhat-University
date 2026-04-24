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
        Schema::connection('wordpress')->table('students_manager', function (Blueprint $table) {
            if (!Schema::connection('wordpress')->hasColumn('students_manager', 'project_id')) {
                $table->unsignedBigInteger('project_id')->nullable()->after('last_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('wordpress')->table('students_manager', function (Blueprint $table) {
            if (Schema::connection('wordpress')->hasColumn('students_manager', 'project_id')) {
                $table->dropColumn('project_id');
            }
        });
    }
};
