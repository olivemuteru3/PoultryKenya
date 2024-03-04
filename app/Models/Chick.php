<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chick extends Model
{
    use HasFactory;

    protected $fillable = [
        'farmerName',
        'farmerPhone',
        'chick_number',
        'date',
        'comments',
    ];
}
