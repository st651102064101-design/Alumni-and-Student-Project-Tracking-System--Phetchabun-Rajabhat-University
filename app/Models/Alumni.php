<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $connection = 'wordpress';
    protected $table = 'alumni';

    protected $fillable = [
        'student_code',
        'prefix',
        'first_name',
        'last_name',
        'email',
        'phone',
        'graduation_year',
        'degree',
        'major',
        'gpa',
        'current_workplace',
        'current_position',
        'job_type',
        'salary',
        'address',
        'province',
        'facebook',
        'line_id',
        'profile_image',
        'status',
        'notes',
    ];

    protected $casts = [
        'graduation_year' => 'integer',
        'gpa' => 'decimal:2',
        'salary' => 'decimal:2',
    ];

    /**
     * Get full name
     */
    public function getFullNameAttribute(): string
    {
        $prefix = $this->prefix ? $this->prefix : '';
        return trim("{$prefix}{$this->first_name} {$this->last_name}");
    }

    /**
     * Get status label in Thai
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'employed' => 'ทำงานแล้ว',
            'unemployed' => 'ยังไม่ทำงาน',
            'self_employed' => 'ประกอบธุรกิจส่วนตัว',
            'further_study' => 'ศึกษาต่อ',
            'other' => 'อื่นๆ',
            default => $this->status,
        };
    }

    /**
     * Get status color for UI
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'employed' => 'success',
            'unemployed' => 'warning',
            'self_employed' => 'info',
            'further_study' => 'primary',
            'other' => 'secondary',
            default => 'secondary',
        };
    }

    /**
     * Get job type label in Thai
     */
    public function getJobTypeLabelAttribute(): string
    {
        return match($this->job_type) {
            'related' => 'ตรงสาขา',
            'unrelated' => 'ไม่ตรงสาขา',
            'further_study' => 'ศึกษาต่อ',
            'other' => 'อื่นๆ',
            default => $this->job_type ?? '-',
        };
    }
}
