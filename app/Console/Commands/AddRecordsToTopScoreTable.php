<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\TopScoreService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class AddRecordsToTopScoreTable extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:add-records-to-top-score-table';

    /**
     * The console command description.
     */
    protected $description = 'Added records to top score table from Api';

    public function __construct(
        private readonly TopScoreService $topScoreService
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->info('Synchronizacja danych najlepszych strzelców...');

        try {
            $count = $this->topScoreService->syncTopScorers();

            $this->info(sprintf('Zsynchronizowano %d strzelców.', $count));
            $this->info('Synchronizacja najlepszych strzelców zakończona!');
        } catch (\Exception $e) {
            $this->error('Wystąpił błąd: ' . $e->getMessage());
            Log::error('Błąd podczas synchronizacji najlepszych strzelców: ' . $e->getMessage());
        }
    }
}
