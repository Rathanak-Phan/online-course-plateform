<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id', 
        'title', 
        'slug', 
        'content', 
        'video_url', 
        'video_path',
        'duration', 
        'order', 
        'is_free', 
        'type',
        'attachment'
    ];

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }
}
