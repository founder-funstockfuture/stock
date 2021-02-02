<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicOwnTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id', 'tag_id', 'tag_name'
    ];


}
