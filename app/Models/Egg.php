<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egg extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmerName',
        'farmerPhone',
        'date',
        'eggs_number',
        'comments',
        'status',
    ];
}
