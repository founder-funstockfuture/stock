<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoCategory extends Model
{
    use HasFactory;
    //public $timestamps = false;

    protected $fillable = [
        'name', 'description',
    ];
    
    public function videos()
    {
        return $this->hasMany(Video::class);
    }



}
