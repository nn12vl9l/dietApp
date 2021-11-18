<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class Charenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'limit_data',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }

    public function getImagePathAttribute()
    {
        return 'images/charenges/' . $this->image;
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    public function getDateDiffAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans(now());
    }

    public function getLimitDataDiffAttribute()
    {
        return Carbon::parse($this->limit_data)->diffInDays($this->created_at);
    }
}
