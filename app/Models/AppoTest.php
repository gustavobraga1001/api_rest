<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppoTest extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_barber',
        'avatar_url',
        'name',
        'service',
        'selectedYear',
        'selectedMonth',
        'selectedDay',
        'selectedHour',
    ];

    protected $casts = [
        'service' => 'array',
        'hours' => 'array'
    ];
}
