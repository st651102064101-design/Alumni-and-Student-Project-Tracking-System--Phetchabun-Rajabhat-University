<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Announcement extends Model
{
    use HasFactory;

    protected $connection = 'wordpress';
    protected $table = 'announcements';

    protected $fillable = [
        'title',
        'content',
        'category',
        'icon',
        'color',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Scope: เฉพาะประกาศที่ active
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: เรียงตามวันที่เผยแพร่ล่าสุด
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Get category label in Thai
     */
    public function getCategoryLabelAttribute(): string
    {
        return match($this->category) {
            'event' => 'กิจกรรม',
            'job' => 'รับสมัครงาน',
            'achievement' => 'ความสำเร็จ',
            'general' => 'ทั่วไป',
            default => $this->category,
        };
    }

    /**
     * Get time ago in Thai
     */
    public function getTimeAgoAttribute(): string
    {
        $published = $this->published_at ?? $this->created_at;
        if (!$published) {
            return '-';
        }

        $diff = Carbon::parse($published)->diffForHumans();
        
        // แปลงเป็นภาษาไทย
        $translations = [
            'second' => 'วินาที',
            'seconds' => 'วินาที',
            'minute' => 'นาที',
            'minutes' => 'นาที',
            'hour' => 'ชั่วโมง',
            'hours' => 'ชั่วโมง',
            'day' => 'วัน',
            'days' => 'วัน',
            'week' => 'สัปดาห์',
            'weeks' => 'สัปดาห์',
            'month' => 'เดือน',
            'months' => 'เดือน',
            'year' => 'ปี',
            'years' => 'ปี',
            'ago' => 'ที่แล้ว',
            'from now' => 'จากนี้',
        ];

        foreach ($translations as $en => $th) {
            $diff = str_replace($en, $th, $diff);
        }

        return $diff;
    }
}
