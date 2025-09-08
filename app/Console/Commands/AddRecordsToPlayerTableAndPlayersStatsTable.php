<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\PlayerService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class AddRecordsToPlayerTableAndPlayersStatsTable extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:add-records-to-player-table-with-stats-table';

    /**
     * The console command description.
     */
    protected $description = 'Added records to player table and player stats table from Api';

    public function __construct(
        private readonly PlayerService $playerService
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Synchronizacja danych zawodników...');

        try {
            $count = $this->playerService->syncPlayers();

            $this->info(sprintf('Zsynchronizowano %d zawodników.', $count));
            $this->info('Synchronizacja zawodników zakończona!');
        } catch (\Exception $e) {
            $this->error('Wystąpił błąd: ' . $e->getMessage());
            Log::error('Błąd podczas synchronizacji zawodników: ' . $e->getMessage());
        }
    }


}
