<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'salesType',
        'price',
        'quantity',
        'total',
        'total',
        'buyerName',
        'buyerPhone',
        'seller',
        'sellerPhone',
    ];

}
