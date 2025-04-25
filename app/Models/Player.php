<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Player extends Model
{
    use HasFactory;

    protected $table = 'player';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'age',
        'number',
        'position',
        'photo'
    ];

    public function playerStats(): HasOne
    {
        return $this->hasOne(PlayerBarcelonaStats::class, 'player_id');
    }

}
