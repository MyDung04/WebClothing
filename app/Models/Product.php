<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'title',
        'price',
        'image',
        'id_user',
        'id_category',
        'id_brand',
        'status',
        'sale',
        'company',
        'detail',
    ];
}
