<?php

namespace App\Services;

use App\Models\Article;

interface ArticleApprovalService
{
    public function approveArticle(Article $article, int $reviewerId);

    public function rejectArticle(Article $article, int $reviewerId);
}