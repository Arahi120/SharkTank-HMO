<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    // Especificamos los campos que son asignables masivamente
    protected $fillable = [
        'name',
        'description',
    ];
}
