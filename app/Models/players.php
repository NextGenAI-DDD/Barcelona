<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class players extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'age',
        'position',
        'birth',
        'place',
        'country',
        'nationality',
        'height',
        'weight',
        'injured',
        'photo',
    ];
}
