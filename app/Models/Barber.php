<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barber extends Model
{
    use HasFactory;

    protected $fillable = [
        'avatar_url',
        'name',
        'starts',
        'services',
        'available'
    ];

    protected $casts = [
        'services' => 'array',
        'available' => 'array'
    ];
}
