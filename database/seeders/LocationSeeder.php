<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = config('locations.states');
        
        foreach ($states as $state) {
            $this->storeLocation($state['name'], $state['children'] ?? null);
        }
    }

    public function storeLocation(string $name, ?array $children = null, ?int $parentId = null)
    {
        $location = Location::create(['name' => $name, 'parent_id' => $parentId]);

        if (!$children) {
            return;
        }
        
        foreach ($children as $child) {
            $this->storeLocation($child['name'], $child['children'] ?? null, $location->id);
        }
    }
}