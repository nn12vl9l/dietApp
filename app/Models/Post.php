<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'charenge_id',
        'created_at',
    ];

    public function getImagePathAttribute()
    {
        return 'images/posts/' . $this->image;
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

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

    public function charenge()
    {
        return $this->belongsTo(Charenge::class);
    }
}
