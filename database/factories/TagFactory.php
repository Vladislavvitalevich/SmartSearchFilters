<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition()
    {
        return [
            'author_id' => User::inRandomOrder()->first()->id,
            'name' => $this->faker->word,
        ];
    }
}
