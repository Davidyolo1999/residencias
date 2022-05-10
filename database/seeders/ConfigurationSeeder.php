<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::create([
            'unit' => 'Unidad de Estudios Superiores Villa Victoria',
            'address'=>'CARRETERA FEDERAL LIBRE 15 NOGALES-MÉXICO, TRAMO TOLUCA-ZITÁCUARO, MARGEN IZQUIERDO, KILÓMETRO 47, BARRIO SAN AGUSTÍN BERROS, 50960 SAN AGUSTÍN BERROS, VILLA VICTORIA, ESTADO DE MÉXICO. A 1.5 KILÓMETROS DE LA GASOLINERA LOS PINOS.',
            'person_in_charge'=>'LCDA. Brenda González Pacheco',
            'person_in_charge_position'=>'COORDINADORA DE LA UNIDAD DE ESTUDIOS SUPERIORES VILLA VICTORIA',
            'person_in_charge_position_abbreviation'=>'Coordinadora de la UES Villa Victoria',
            'email'=>'uesvillavictoria@umb.mx',
            'office_phone_number'=>'(01 726) 251 63 13',
            'personal_phone_number'=>'722 764 6671',
            'institution_code'=>'15ESU0026Q',
        ]);
    }
}
