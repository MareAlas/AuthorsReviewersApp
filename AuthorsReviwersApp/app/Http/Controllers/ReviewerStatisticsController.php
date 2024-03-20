<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Services\ReviewerStatisticsService;
use App\Services\ArticleApprovalService;

class ReviewerStatisticsController extends Controller
{
    protected $reviewerStatisticsService;

    public function __construct(ReviewerStatisticsService $reviewerStatisticsService)
    {
        $this->reviewerStatisticsService = $reviewerStatisticsService;
    }


    public function index()
    {
        //$userId = auth()->user()->id;
        $success = $this->reviewerStatisticsService->getReviewerStatistics();

        if ($success) {
            return response()->json(['message' => 'Article approved for publication'], 200);
        } else {
            return response()->json(['error' => 'Failed to approve article'], 500);
        }

        //$statistics = $articleApprovalService->getReviewerStatistics();

        //return view('reviewer.statistics', compact('statistics'));
    }
}
