<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicSubscription extends Model
{
    use HasFactory;

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

}
