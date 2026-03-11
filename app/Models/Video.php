<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['name', 'url'];

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_video_access',
            'video_id',
            'user_id'
        );
    }
}
