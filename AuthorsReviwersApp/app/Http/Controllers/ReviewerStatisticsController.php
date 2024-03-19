<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ReviewerStatisticsService;

class ReviewerStatisticsController extends Controller
{
    public function index2(ReviewerStatisticsService $statsService)
    {
        $statistics = $statsService->getReviewerStatistics();

        return view('reviewer.statistics', compact('statistics'));
    }
}
