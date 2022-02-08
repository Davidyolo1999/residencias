<?php

namespace Database\Seeders;

use App\Models\Career;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Career::create([
            'name' => 'Licenciatura en Informática',
            'abreviation'=>'LI',
        ]);
        Career::create([
            'name' => 'Licenciatura en Derecho',
            'abreviation'=>'LD',
        ]);
        Career::create([
            'name' => ' Licenciatura en Contaduría',
            'abreviation'=>'LC',
        ]);
        Career::create([
            'name' => 'Licenciatura en Psicología Industrial',
            'abreviation'=>'LPI',
        ]);
    }
}
