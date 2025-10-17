<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cmt extends Model
{
    use HasFactory;
    protected $table = "comment";
    protected $fillable = [
        'cmt',
        'id_user',
        'id_blog',
        'user_name',
        'avatar',
        'created_at',
        'level',
    ];
}
