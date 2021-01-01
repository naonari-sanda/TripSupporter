<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Country extends Model
{
    protected $guarded = [
        'id',
    ];

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }
}
