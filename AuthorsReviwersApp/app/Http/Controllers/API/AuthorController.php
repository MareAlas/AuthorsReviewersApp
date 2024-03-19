<?php

namespace App\Http\Controllers\API;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;

class AuthorController extends Controller
{
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Submit an article for review.
     *
     * @param  ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function submitArticle(ArticleRequest $request)
    {
        $article = $this->articleService->submitArticle($request->validated());
        return response()->json(['message' => 'Article submitted for review'], 201);
    }
}
