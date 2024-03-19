<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuthorsArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::all()->each(function ($article) {
            $authors = Author::factory(rand(1, 3))->create();
            $article->authors()->attach($authors);
        });
    }
}
