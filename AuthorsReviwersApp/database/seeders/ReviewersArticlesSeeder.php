<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Reviewer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReviewersArticlesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::all()->each(function ($article) {
            $reviewers = Reviewer::factory(rand(1, 3))->create();
            $article->reviewers()->attach($reviewers);
        });
    }
}
