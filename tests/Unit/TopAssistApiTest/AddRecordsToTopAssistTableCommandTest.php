<?php

namespace Tests\Unit\TopAssistApiTest;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddRecordsToTopAssistTableCommandTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test checking the behavior of the artisan command.
     *
     * @return void
     */
    public function testAddRecordsToTopAssistTableCommand()
    {
        // Execute the artisan command
        $this->artisan('app:add-records-to-top-assist-table')
            ->assertExitCode(0); // Expected exit code (0 means success)
    }
}
