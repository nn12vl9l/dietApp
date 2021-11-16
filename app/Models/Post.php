<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'charenge_id',
        'created_at',
        // 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
