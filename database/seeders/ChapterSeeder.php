<?php

namespace Database\Seeders;

use App\Models\Chapter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChapterSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    Chapter::factory()->create([
      'country_id' => 142,        // México
      'city_id' => 68588,         // Benito Juarez
      'leader_id' => 3,           // Elsa Maldonado
      'year' => 2016
    ]);

    Chapter::factory()->create([
      'country_id' => 239,        // Venezuela
      'city_id' => 130165,        // Valencia
      'leader_id' => 4,           // Carlos Aguilera
      'year' => 2019
    ]);

    Chapter::factory()->create([
      'country_id' => 239,        // Venezuela
      'city_id' => 130104,        // Maracay
      'leader_id' => 6,           // Dayan Betancourt
      'year' => 2016,
      'website' => 'https://hfmaracay.com'
    ]);
  }
}
