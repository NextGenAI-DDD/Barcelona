<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\PlayerService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class AddRecordsToPlayerTable extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:add-records-to-player-table';

    /**
     * The console command description.
     */
    protected $description = 'Added records to player and player_stats tables from Api';

    public function __construct(
        private readonly PlayerService $playerService
    ) {
        parent::__construct();
    }

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