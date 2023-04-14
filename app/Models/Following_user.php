<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following_user extends Model
{
    use HasFactory;

    protected $table = "following_users";

    protected $fillable = [
        'user_id',
        'follow_user_id',
    ];

    public function user()
    {
        return $this->belongsToMany(\App\Models\User::class,'following_users','request_user_id', 'user_id');
    }
}
