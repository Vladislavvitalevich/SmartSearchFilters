<?php

namespace Database\Factories;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class IssueFactory extends Factory
{
    protected $model = Issue::class;

    public function definition()
    {
        
        $assigner_id = User::inRandomOrder()->first()->id;
        $assignee_id = User::where('id', '!=', $assigner_id)->inRandomOrder()->first()->id;
        
        return [
            'assigner_id' => $assigner_id,
            'assignee_id' => $assignee_id,
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'priority' => $this->faker->randomElement([1,2,3]),
            'status_id' => $this->faker->randomElement(['Backlog', 'Todo', 'In progress', 'In testing', 'Done']),
            'story_points' => $this->faker->randomElement([1,2,3,4,5,6,7,8])
        ];
    }
}
