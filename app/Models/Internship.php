<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    protected $connection = 'wordpress'; // Using same DB connection as projects

    protected $fillable = [
        'student_id',
        'student_name',
        'company_name',
        'company_address',
        'job_role',
        'start_date',
        'end_date',
        'status',
        'academic_year',
        'semester',
    ];

    /**
     * Get status label in Thai
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending' => 'รอดำเนินการ',
            'in_progress' => 'กำลังฝึกงาน',
            'completed' => 'เสร็จสิ้น',
            default => $this->status,
        };
    }

    /**
     * Get status color for UI
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'orange',
            'in_progress' => 'blue',
            'completed' => 'green',
            default => 'gray',
        };
    }
}
