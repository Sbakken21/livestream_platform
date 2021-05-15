<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Stream extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Set the intial score
     */
    public static function setViewCount($name)
    {
        Redis::zincrby("top-streams", 1, $name);
    }

    public static function removeStream($name)
    {
        Redis::zrem('top-streams', $name);
    }
}
