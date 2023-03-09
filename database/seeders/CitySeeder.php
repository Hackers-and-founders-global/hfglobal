<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/sql/cities1.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Cities 1 table seeded!');

        $path = 'database/sql/cities2.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Cities 2 table seeded!');

        $path = 'database/sql/cities3.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Cities 3 table seeded!');

        $path = 'database/sql/cities4.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Cities 4 table seeded!');

        $path = 'database/sql/cities5.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Cities 5 table seeded!');
    }
}
