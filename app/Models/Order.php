<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $table = "Order";
    protected $fillable = [
        'id',
        'id_user',

        'total',
    ];
}
