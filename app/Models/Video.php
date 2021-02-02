<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Video extends Model
{
    use HasFactory;
    use SoftDeletes;

    
    protected $fillable = ['title', 'youtube_url', 'user_id', 'category_id', 
    'excerpt', 'on_sale', 'coin', 'is_show'];

    public function Category()
    {
        return $this->belongsTo(VideoCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(VideoReply::class);
    }

    public function ownTags()
    {
        return $this->hasMany(VideoOwnTag::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(TopicSubscription::class);
    }
    
    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的數據讀取邏輯
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
        // 當話題有新回覆時，我們將編寫邏輯來更新話題模型的 reply_count 屬性，
        // 此時會自動觸發框架對數據模型 updated_at 時間戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    public function scopeRecent($query)
    {
        // 按照創建時間排序
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
        return route('video.show', array_merge([$this->id, $this->title], $params));
    }

    public function updateReplyCount()
    {
        $this->reply_count = $this->replies->count();
        $this->save();
    }
    
    public function subscribe($userId)
    {
        $this->subscriptions()->create([
            'user_id' => $userId
        ]);

        return $this;
    }

    public function unsubscribe($userId)
    {
        $this->subscriptions()
            ->where('user_id', $userId)
            ->delete();

        return $this;
    }

}
