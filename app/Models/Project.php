<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Project extends Model
{
    use HasFactory;

    protected $connection = 'wordpress';

    protected $fillable = [
        'project_code',
        'title',
        'description',
        'category',
        'academic_year',
        'semester',
        'advisor',
        'members',
        'status',
        'document_url',
        'repository_url',
        'thumbnail',
        'score',
        'notes',
    ];

    protected $casts = [
        'members' => 'array',
        'academic_year' => 'integer',
        'score' => 'integer',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'project_id');
    }

    public function getMemberNamesAttribute(): array
    {
        return $this->students->map(function (Student $student) {
            return trim((string) ($student->first_name . ' ' . $student->last_name));
        })->all();
    }

    /**
     * Get status label in Thai
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'proposal' => 'เสนอโครงงาน',
            'in_progress' => 'กำลังดำเนินการ',
            'completed' => 'เสร็จสิ้น',
            'cancelled' => 'ยกเลิก',
            default => $this->status,
        };
    }

    /**
     * Get status color for UI
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'proposal' => 'orange',
            'in_progress' => 'blue',
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'gray',
        };
    }
}
