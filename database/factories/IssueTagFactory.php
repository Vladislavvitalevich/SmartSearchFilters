<?php

namespace Database\Factories;

use App\Models\Issue;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class IssueTagFactory extends Factory
{
    protected $model = Issue::class;

    public function definition()
    {
        return [
            'issue_id' => Issue::factory(),
            'tag_id' => Tag::factory(),
        ];
    }
}
