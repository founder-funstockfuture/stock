<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoOwnTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'video_id', 'tag_id', 'tag_name'
    ];


}
