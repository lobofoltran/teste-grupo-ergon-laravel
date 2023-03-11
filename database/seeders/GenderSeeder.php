<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    private array $genders = [
        ['name' => 'Ação'],
        ['name' => 'Aventura'],
        ['name' => 'Cinema de arte'],
        ['name' => 'Chanchada'],
        ['name' => 'Comédia'],
        ['name' => 'Comédia de ação'],
        ['name' => 'Comédia de terror'],
        ['name' => 'Comédia dramática'],
        ['name' => 'Comédia romântica'],
        ['name' => 'Dança'],
        ['name' => 'Documentário'],
        ['name' => 'Docuficção'],
        ['name' => 'Drama'],
        ['name' => 'Espionagem'],
        ['name' => 'Faroeste'],
        ['name' => 'Fantasia'],
        ['name' => 'Fantasia científica'],
        ['name' => 'Ficção científica'],
        ['name' => 'Filmes com truques'],
        ['name' => 'Filmes de guerra'],
        ['name' => 'Mistério'],
        ['name' => 'Musical'],
        ['name' => 'Filme policial'],
        ['name' => 'Romance'],
        ['name' => 'Terror'],
        ['name' => 'Thriller']
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gender::factory()
            ->count(sizeof($this->genders))
            ->sequence(...$this->genders)
            ->create();
    }
}
