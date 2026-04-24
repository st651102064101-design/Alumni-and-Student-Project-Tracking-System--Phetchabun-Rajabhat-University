<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Project;

class Student extends Authenticatable
{
    use HasFactory;

    protected $connection = 'wordpress';
    protected $table = 'students_manager';

    protected $fillable = [
        'id',
        'std_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'photo_id',
        'attachments',
        'project_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'project_id' => 'integer',
        'attachments' => 'array',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function getNameAttribute(): string
    {
        return trim((string) ($this->first_name . ' ' . $this->last_name));
    }
}
