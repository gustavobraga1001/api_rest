<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'dia',
        'mes',
        'ano'
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }
}
