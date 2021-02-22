<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reply2 extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'replies2';

    protected $fillable = ['reply_id','user_id','content'];

    public function reply()
    {
        return $this->belongsTo(Reply2::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}