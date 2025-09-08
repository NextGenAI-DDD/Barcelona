<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\LaLigaService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class AddRecordsToLaLigaTable extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-records-to-la-liga-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add records to table la-liga-table';

    public function __construct(
        private readonly LaLigaService $laLigaService
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Synchronizacja danych tabeli La Liga...');

        try {
            $count = $this->laLigaService->syncStandings();

            $this->info(sprintf('Zsynchronizowano %d drużyn.', $count));
            $this->info('Synchronizacja tabeli La Liga zakończona!');
        } catch (\Exception $e) {
            $this->error('Wystąpił błąd: ' . $e->getMessage());
            Log::error('Błąd podczas synchronizacji tabeli La Liga: ' . $e->getMessage());
        }
    }
}
 