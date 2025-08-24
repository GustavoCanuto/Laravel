<?php

namespace App\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dog extends Model
{

    use HasFactory;

    protected $fillable = [
        'raca',
        'nome',
    ];
}
