<?php

namespace Database\Factories;

use App\Models\Gender;
use App\Models\Post;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'conclued' => false,
            'user_id' => User::factory(),
            'type_id' => Type::factory(),
            'gender_id' => Gender::factory(),
            'name' => fake()->catchPhrase(),
        ];
    }
}
