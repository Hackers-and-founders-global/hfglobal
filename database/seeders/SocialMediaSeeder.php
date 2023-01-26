<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocialMedia::factory()->create(['name' => 'Facebook']);
        SocialMedia::factory()->create(['name' => 'Twitter']);
        SocialMedia::factory()->create(['name' => 'Instagram']);
        SocialMedia::factory()->create(['name' => 'LinkedIn']);
        SocialMedia::factory()->create(['name' => 'Meetup']);
        SocialMedia::factory()->create(['name' => 'WhatsApp']);
        SocialMedia::factory()->create(['name' => 'Telegram']);
        SocialMedia::factory()->create(['name' => 'Github']);
        SocialMedia::factory()->create(['name' => 'Gitlab']);
        SocialMedia::factory()->create(['name' => 'Slack']);
        SocialMedia::factory()->create(['name' => 'Discord']);
    }
}
