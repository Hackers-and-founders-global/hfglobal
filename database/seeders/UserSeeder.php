<?php

namespace Database\Seeders;

use App\Models\{User, Occupation};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::factory()->create([
          'firstname' => 'Jonathan',
          'lastname' => 'Nelson',
          'email' => 'j@hf.cx',
          'password' => bcrypt('jonathan123'),
          'gender' => 'M',
          'occupation_id' => 3
        ]);

        User::factory()->create([
          'firstname' => 'Laura',
          'lastname' => 'Nelson',
          'email' => 'l@hf.cx',
          'password' => bcrypt('laura123'),
          'gender' => 'F',
          'occupation_id' => 3
        ]);

        User::factory()->create([
          'firstname' => 'Elsa',
          'lastname' => 'Maldonado',
          'email' => 'elsa@hf.cx',
          'password' => bcrypt('elsa123'),
          'gender' => 'F',
          'occupation_id' => 4
        ]);

        User::factory()->create([
          'firstname' => 'Carlos',
          'lastname' => 'Aguilera',
          'email' => 'carlos@hf.cx',
          'password' => bcrypt('carlos123'),
          'gender' => 'M',
          'occupation_id' => 1
        ]);

        User::factory()->create([
          'firstname' => 'Camilo',
          'lastname' => 'Torres',
          'email' => 'camilo@hf.cx',
          'password' => bcrypt('camilo123'),
          'gender' => 'M',
          'occupation_id' => 9
        ]);

        User::factory()->create([
          'firstname' => 'Dayan',
          'lastname' => 'Betancourt',
          'email' => 'dayan@hf.cx',
          'password' => bcrypt('dayan123'),
          'gender' => 'F',
          'birthdate' => '1986-03-04',
          'phone' => '(424)-317-2126',
          'website' => 'delfinbeta.tech',
          'occupation_id' => 1
        ]);
    }
}
