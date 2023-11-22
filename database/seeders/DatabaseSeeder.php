<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Issue;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $users = User::factory(10)->create();
         
        $issues = Issue::factory(10)->create();
 
        $tags = Tag::factory(10)->create();

        $issues->each(function ($issue) use ($tags) {
            $issue->tags()->attach($tags->random(rand(1, 10))->pluck('id')->toArray());
        });

    }
}
