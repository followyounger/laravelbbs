<?php

namespace App\Models;


class Reply extends Model
{
    protected $fillable = ['content'];

    // 一条回复对应一个话题，，一个回复对应一个用户
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
