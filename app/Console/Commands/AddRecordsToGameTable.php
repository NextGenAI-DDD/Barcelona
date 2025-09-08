<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\GameService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class addRecordsToGameTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-records-to-game-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add records to table game';

    public function __construct(
        private readonly GameService $gameService
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Synchronizacja danych meczów...');

        try {
            $count = $this->gameService->syncGames();

            $this->info(sprintf('Zsynchronizowano %d meczów.', $count));
            $this->info('Synchronizacja meczów zakończona!');
        } catch (\Exception $e) {
            $this->error('Wystąpił błąd: ' . $e->getMessage());
            Log::error('Błąd podczas synchronizacji meczów: ' . $e->getMessage());
        }
    }


}