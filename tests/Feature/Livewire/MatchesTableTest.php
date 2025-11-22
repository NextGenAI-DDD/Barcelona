<?php

namespace Tests\Feature\Livewire;

use App\Livewire\MatchesTable;
use Tests\TestCase;

class MatchesTableTest extends TestCase
{
    public function test_component_class_exists()
    {
        $this->assertTrue(class_exists(MatchesTable::class));
    }

    public function test_component_has_required_properties()
    {
        $reflection = new \ReflectionClass(MatchesTable::class);
        
        $this->assertTrue($reflection->hasProperty('dateFilter'));
        $this->assertTrue($reflection->hasProperty('textFilter'));
        $this->assertTrue($reflection->hasProperty('sortBy'));
        $this->assertTrue($reflection->hasProperty('sortDirection'));
    }

    public function test_component_has_required_methods()
    {
        $reflection = new \ReflectionClass(MatchesTable::class);
        
        $this->assertTrue($reflection->hasMethod('sortBy'));
        $this->assertTrue($reflection->hasMethod('updatedDateFilter'));
        $this->assertTrue($reflection->hasMethod('updatedTextFilter'));
        $this->assertTrue($reflection->hasMethod('mount'));
        $this->assertTrue($reflection->hasMethod('render'));
    }

    public function test_component_extends_livewire_component()
    {
        $this->assertTrue(is_subclass_of(MatchesTable::class, \Livewire\Component::class));
    }
}
