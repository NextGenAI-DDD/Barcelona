<?php

namespace Tests\Unit\TopScoreApiTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddRecordsToTopScoreTableCommandTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test checking the behavior of the artisan command.
     *
     * @return void
     */
    public function testAddRecordsToTopScoreTableCommand()
    {
        // Execute the artisan command
        $this->artisan('app:add-records-to-top-assist-table')
            ->assertExitCode(0); // Expected exit code (0 means success)
    }
}
