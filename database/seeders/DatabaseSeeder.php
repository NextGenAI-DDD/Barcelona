<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\LaLigaTable;
use App\Models\Player;
use App\Models\PlayerBarcelonaStats;
use App\Models\TopAssist;
use App\Models\TopScore;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
         TopAssist::factory(10)->create();
         LaLigaTable::factory(10)->create();
         TopScore::factory(10)->create();
         Player::factory(10)->create();
         PlayerBarcelonaStats::factory(10)->create();
    }
}
