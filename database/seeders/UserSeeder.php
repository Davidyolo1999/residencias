<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::factory()->create([
            'email' => 'admin@admin.com',
            'role' => User::ADMIN_ROLE,
        ]);

        $adminUser->admin()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
        ]);

        $teacherUser = User::factory()->create([
            'email' => 'pedro@gmail.com',
            'role' => User::TEACHER_ROLE,
        ]);

        $teacherUser->teacher()->create([
            'first_name' => 'Pedro',
            'fathers_last_name' => 'Perez',
            'mothers_last_name' => 'Lopez',
            'sex' => 'f',
            'curp' => '12356456454564466',
            'phone_number' => '4261249733',
            'state_id' => 1,
            'municipality_id' => 2,
            'locality_id' => 3,
        ]);

        $externalAdvisorUser = User::factory()->create([
            'email' => 'josefa@gmail.com',
            'role' => User::EXTERNAL_ADVISOR_ROLE,
        ]);

        $externalAdvisorUser->externalAdvisor()->create([
            'first_name' => 'Josefa',
            'fathers_last_name' => 'Camejo',
            'mothers_last_name' => 'Perez',
            'sex' => 'f',
            'curp' => '12356456454564462',
            'phone_number' => '4261249733',
            'charge' => 'el cargo',
            'career' => 'la carrera',
            'state_id' => 1,
            'municipality_id' => 2,
            'locality_id' => 3,
        ]);

        $studentUser = User::factory()->create([
            'email' => 'oralis@gmail.com',
            'role' => User::STUDENT_ROLE,
        ]);

        $studentUser->student()->create([
            'first_name' => 'Oralis',
            'fathers_last_name' => 'Valerio',
            'mothers_last_name' => 'Vargas',
            'account_number' => '21170146',
            'sex' => 'f',
            'curp' => 'FOBD990707HMCLNV06',
            'career_percentage' => 90,
            'phone_number' => '4261249733',
            'is_enrolled' => true,
            'is_social_service_concluded' => true,
            'career_id' => 1,
            'teacher_id' => $teacherUser->id,
            'external_advisor_id' => $externalAdvisorUser->id,
            'state_id' => 1,
            'municipality_id' => 2,
            'locality_id' => 3,
        ]);
    }
}
