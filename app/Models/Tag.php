<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Encore\Admin\Traits\DefaultDatetimeFormat;

class Tag extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;


    protected $fillable = [
        'user_id', 'tag_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ownTopics()
    {
        return $this->belongsToMany(Topic::class, 'topic_own_tags')
            ->withTimestamps()
            ->orderBy('topic_own_tags.created_at', 'desc');
    }

    public function ownVideos()
    {
        return $this->belongsToMany(Topic::class, 'video_own_tags')
            ->withTimestamps()
            ->orderBy('video_own_tags.created_at', 'desc');
    }
    
}
