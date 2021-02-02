<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Hashids;


class Topic extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Traits\HashIdHelper;


    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'excerpt'];

    public function Category()
    {
        return $this->belongsTo(TopicCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function ownTags()
    {
        return $this->hasMany(TopicOwnTag::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(TopicSubscription::class);
    }

    public function scopeWithOrder($query, $order)
    {
        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
    }

    public function scopeRecentReplied($query)
    {
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
    

    public function scopeWithTag($query, $tag)
    {
        $tag_topic_ids=TopicOwnTag::select('topic_id')->where('tag_name',$tag);
        
        if (!is_array($tag_topic_ids)) {
            $tag_topic_ids = [$tag_topic_ids];
        }

        return $query->whereIn('id',$tag_topic_ids);
    }

    public function scopePublished($query)
    {
        return $query->where('is_show',1)
        ->where('is_blocked',0)
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now());
    }

    public function link($params = [])
    {
        return route('topics.show', array_merge([Hashids::encode($this->id), $this->title], $params));
    }

    public function updateReplyCount()
    {
        $this->reply_count = $this->replies->count();
        $this->save();
    }
    
}
