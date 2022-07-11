<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use App\Models\Question;
use App\Models\QuestionTag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //user
        User::create([
            'name' => 'Kyaw Ko Ko Oo',
            'email' => 'kyawkokooo@gmail.com',
            'password' => Hash::make('triplekay'),
        ]);

        User::create([
            'name' => 'Triple K',
            'email' => 'triplekay@gmail.com',
            'password' => Hash::make('triplekay'),
        ]);

        //question
        Question::create([
            'slug' => Str::slug("What is lorem ipsum"),
            'title' => 'What is Lorem Ipsum?',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. At, voluptatum quam laboriosam placeat laudantium incidunt atque dicta voluptatibus ullam, aut, itaque reiciendis pariatur. Praesentium officia nostrum ex sunt, cum consectetur.",
            'user_id' => "1",
        ]);

        Question::create([
            'slug' => Str::slug("What is Javascript"),
            'title' => 'What is Javascript?',
            'description' => "Javascript dolor sit amet consectetur adipisicing elit. At, voluptatum quam laboriosam placeat laudantium incidunt atque dicta voluptatibus ullam, aut, itaque reiciendis pariatur. Praesentium officia nostrum ex sunt, cum consectetur.",
            'user_id' => "1",
        ]);

        Question::create([
            'slug' => Str::slug("Vue js is a framework or library"),
            'title' => 'Vue js is a framework or library?',
            'description' => "Javascript dolor sit amet consectetur adipisicing elit. At, voluptatum quam laboriosam placeat laudantium incidunt atque dicta voluptatibus ullam, aut, itaque reiciendis pariatur. Praesentium officia nostrum ex sunt, cum consectetur.",
            'user_id' => "1",
        ]);

        //tags
        Tag::create([
            'slug' => Str::slug("Web Development"),
            'name' => "Web Development",
        ]);

        Tag::create([
            'slug' => Str::slug("Javascript"),
            'name' => "Javascript",
        ]);

        Tag::create([
            'slug' => Str::slug("Web Design"),
            'name' => "Web Design",
        ]);

        //question tags
        QuestionTag::create([
            'question_id' => '1',
            'tag_id' => '1',
        ]);
        QuestionTag::create([
            'question_id' => '2',
            'tag_id' => '2',
        ]);
        QuestionTag::create([
            'question_id' => '3',
            'tag_id' => '3',
        ]);
    }
}