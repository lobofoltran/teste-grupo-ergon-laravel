<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    private array $types = [
        ['name' => 'Filmes'],
        ['name' => 'Séries'],
        ['name' => 'Minisséries'],
        ['name' => 'Novelas'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::factory()
            ->count(sizeof($this->types))
            ->sequence(...$this->types)->create();
    }
}
