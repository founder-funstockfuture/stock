<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Encore\Admin\Traits\DefaultDatetimeFormat;


class Charity extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;

    
    protected $fillable = [
        'love_name',
        'love_code',
        'enabled',
    ];
	
    protected $casts = [
        'enabled' => 'boolean',
    ];

}
