<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

    public static function resetPlayerTable()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('players')->truncate();
        Schema::enableForeignKeyConstraints();
    }

}
