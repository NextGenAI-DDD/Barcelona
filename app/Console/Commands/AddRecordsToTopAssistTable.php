<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Services\TopAssistService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

final class AddRecordsToTopAssistTable extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:add-records-to-top-assist-table';

    /**
     * The console command description.
     */
    protected $description = 'Added records to top assist table from Api';

    public function __construct(
        private readonly TopAssistService $topAssistService
    ) {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->info('Synchronizacja danych najlepszych asystujących...');

        try {
            $count = $this->topAssistService->syncTopAssists();

            $this->info(sprintf('Zsynchronizowano %d asystujących.', $count));
            $this->info('Synchronizacja najlepszych asystujących zakończona!');
        } catch (\Exception $e) {
            $this->error('Wystąpił błąd: ' . $e->getMessage());
            Log::error('Błąd podczas synchronizacji najlepszych asystujących: ' . $e->getMessage());
        }
    }
}
