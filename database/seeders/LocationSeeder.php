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
        $mexico = Location::create(['name' => 'México']);
        $villaDeAllende = Location::create(['name' => 'Villa de allende', 'parent_id' => $mexico->id]);
        Location::create(['name' => 'San Ildefonso', 'parent_id' => $villaDeAllende->id]);
    }
}
