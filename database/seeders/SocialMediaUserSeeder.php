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
        $user->social_medias()->attach(3, [
            'url' => 'https://www.instagram.com/carlosaguileradev/', 'created_at' => now(), 'updated_at' => now()
        ]);

        $user = User::find(6);
        $user->social_medias()->attach(1, [
            'url' => 'https://www.facebook.com/delfinbeta', 'created_at' => now(), 'updated_at' => now()
        ]);
        $user->social_medias()->attach(2, [
            'url' => 'https://twitter.com/delfinbeta', 'created_at' => now(), 'updated_at' => now()
        ]);
        $user->social_medias()->attach(3, [
            'url' => 'https://www.instagram.com/delfinbeta/', 'created_at' => now(), 'updated_at' => now()
        ]);
    }
}
