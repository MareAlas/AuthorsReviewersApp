<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Reviewer;
use App\Enums\ArticleStatus;
use Illuminate\Http\Request;
use App\Services\ArticleService;
use App\Services\ArticleApprovalService;

class ReviewerDashboardController extends Controller
{
    protected $articleApprovalService;

    public function __construct(ArticleApprovalService $articleApprovalService)
    {
        $this->articleApprovalService = $articleApprovalService;
    }

     /**
     * Approve an article for publication.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function approveArticle(Request $request, Article $article)
    {
        $userId = auth()->user()->id;
        $success = $this->articleApprovalService->approveArticle($article, $userId);

        if ($success) {
            return response()->json(['message' => 'Article approved for publication'], 200);
        } else {
            return response()->json(['error' => 'Failed to approve article'], 500);
        }
    }

    /**
     * Reject an article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function rejectArticle(Request $request, Article $article)
    {
        $userId = auth()->user()->id;
        $success = $this->articleApprovalService->rejectArticle($article, $userId);

        if ($success) {
            return response()->json(['message' => 'Article rejected'], 200);
        } else {
            return response()->json(['error' => 'Failed to reject article'], 500);
        }
    }

    /**
     * Publish an approved article.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function publishArticle(Request $request, Article $article)
    {
        $userId = auth()->user()->id;
        $success = $this->articleApprovalService->publishArticle($article, $userId);

        if ($success) {
            return response()->json(['message' => 'Article published successfully'], 200);
        } else {
            return response()->json(['error' => 'Failed to publish article'], 500);
        }
    }
}
