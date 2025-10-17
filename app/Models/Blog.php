<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $table = "Blog";
    public $timestamps = false;
    protected $fillable = [
        'id',
        'title',
        'image',
        'description',
        'content',
    ];
}
