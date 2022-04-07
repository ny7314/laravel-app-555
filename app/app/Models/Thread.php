<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use HasFactory;

    protected $table = 'threads';

    protected $fillable = [
        'title', 'user_id', 'is_user_checked', 'latest_comment_time'
    ];
}
