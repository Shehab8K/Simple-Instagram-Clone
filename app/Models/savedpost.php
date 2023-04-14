<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class savedpost extends Model
{
    use HasFactory;

    protected $table = "savedposts";

    protected $fillable = [
        'user_id',
        'post_id'
     ];

}
