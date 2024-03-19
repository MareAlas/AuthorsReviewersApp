<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Article;
use App\Models\Reviewer;
use App\Enums\ArticleStatus;
use Illuminate\Support\Facades\DB;

class ArticleService
{
    public function submitArticle($requestData)
    {
        $article = new Article([
            'title' => $requestData['title'],
            'content' => $requestData['content'],
        ]);
        $article->save();
        $author = Author::find(1);
        $article->authors()->attach($author);
        return $article;
    }
}
