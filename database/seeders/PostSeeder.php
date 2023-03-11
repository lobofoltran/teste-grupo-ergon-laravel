<?php

namespace Database\Seeders;

use App\Models\Follow;
use App\Models\Gender;
use App\Models\Post;
use App\Models\Type;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::factory()
            ->state([
                'name' => 'Tyler, the Creator',
                'email' => 'tylerthecreator@email.com',
                'password' => Hash::make('1234'),
            ])
            ->has(Post::factory()
                ->state([
                    'type_id' => Type::where('name', '=', 'Filmes')->first()->id,
                    'gender_id' => Gender::where('name', 'Ação')->first()->id,
                ])
                ->count(3))
            ->create();

        User::factory()
            ->state([
                'name' => 'Playboi Carti',
                'email' => 'playboicarti@email.com',
                'password' => Hash::make('1234'),
            ])
            ->has(Vote::factory()
                ->state(['post_id' => Type::first()])
                ->count(1))
            ->has(Follow::factory()
                ->state(['post_id' => Type::first()])
                ->count(1))
            ->create();
    }
}
