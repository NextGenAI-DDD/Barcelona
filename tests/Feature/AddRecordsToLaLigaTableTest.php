<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddRecordsToLaLigaTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_adds_records_to_la_liga_table()
    {
        // Wykonaj polecenie konsolowe
        $this->artisan('add-records-to-la-liga-table')
            ->assertExitCode(0); // Sprawdź, czy polecenie zakończyło się bez błędów (kod wyjścia 0)

        // Sprawdź, czy dane zostały dodane do tabeli LaLigaTable
        $recordCount = LaLigaTable::count();

        // Jeśli brak rekordów, oczekujemy wyjątku
        if ($recordCount === 0) {
            $this->expectException(\Exception::class);
        }
    }
}
