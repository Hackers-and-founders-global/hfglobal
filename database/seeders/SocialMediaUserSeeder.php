<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(4);
        $user->social_medias()->attach(3, ['url' => 'https://www.instagram.com/carlosaguileradev/']);

        $user = User::find(6);
        $user->social_medias()->attach(1, ['url' => 'https://www.facebook.com/delfinbeta']);
        $user->social_medias()->attach(2, ['url' => 'https://twitter.com/delfinbeta']);
        $user->social_medias()->attach(3, ['url' => 'https://www.instagram.com/delfinbeta/']);
    }
}
