<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public $table = "OrderDetail";
    protected $fillable = [
        'id',
        'id_order',
        'id_product',
        'quantity',
        'price',
    ];
}
