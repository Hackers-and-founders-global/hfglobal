<?php

namespace Database\Seeders;

use App\Models\Occupation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Occupation::factory()->create(['name' => 'Programación']);
        Occupation::factory()->create(['name' => 'Industria']);
        Occupation::factory()->create(['name' => 'Comercio']);
        Occupation::factory()->create(['name' => 'Administración']);
        Occupation::factory()->create(['name' => 'Educación']);
        Occupation::factory()->create(['name' => 'Gobierno']);
        Occupation::factory()->create(['name' => 'Automotriz']);
        Occupation::factory()->create(['name' => 'Minería']);
        Occupation::factory()->create(['name' => 'Publicidad']);
        Occupation::factory()->create(['name' => 'Banca']);
    }
}
