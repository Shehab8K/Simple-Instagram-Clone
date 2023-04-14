<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'caption',
        'image',
        'tags',
        'likes',
        'user_id',
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function comments()
    {
        return $this->hasMany(\App\Models\Comments::class);
    }

    public function tags()
    {
        return $this->hasMany(\App\Models\Tag::class);
    }

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

    public function savedposts()
    {
        return $this->belongsToMany(\App\Models\User::class,"savedposts");
    }
}
