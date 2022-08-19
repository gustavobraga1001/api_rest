<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
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
        'selectedHour'
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }
}
