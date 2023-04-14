<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $table = "users";

    protected $fillable = [
        'name',
        'email',
        'username',
        'phone',
        'password',
        'avatar',
        'bio',
        'gender',
        'website',
        'email_verified_at',
        'no_of_posts',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }

    public function followings()
    {
        return $this->belongsToMany(\App\Models\User::class, 'following_users', 'user_id', 'follow_user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(\App\Models\User::class, 'following_users', 'follow_user_id', 'user_id');
    }

    public function profile()
    {
        return $this->hasOne(\App\Models\Profile::class);
    }

    public function comment()
    {
        return $this->hasMany(\App\Models\Comments::class);
    }

    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class);
    }

    public function savedposts()
    {
        return $this->belongsToMany(\App\Models\Post::class, "savedposts");
    }
}
