<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Student extends Authenticatable
{
    use HasFactory;

    protected $table = 'wp_students_manager';

    protected $fillable = [
        'id',
        'std_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'photo_id',
        'attachments',
        'created_at',
        'updated_at',
    ];
}
