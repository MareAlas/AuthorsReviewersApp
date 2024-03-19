<?php

use Illuminate\Support\Facades\DB;

class ReviewerStatisticsService
{
    public function getReviewerStatistics()
    {
        $reviewedArticles = DB::table('reviewers_articles')
            ->select('reviewer_id', DB::raw('COUNT(*) as total_reviewed_articles'))
            ->groupBy('reviewer_id')
            ->get();

        $approvedArticles = DB::table('reviewers_articles')
            ->select('reviewer_id', DB::raw('COUNT(*) as total_approved_articles'))
            ->where('approved', true)
            ->groupBy('reviewer_id')
            ->get();

        $statistics = [];
        foreach ($reviewedArticles as $reviewed) {
            $statistics[$reviewed->reviewer_id] = [
                'total_reviewed_articles' => $reviewed->total_reviewed_articles,
                'total_approved_articles' => 0,
            ];
        }

        foreach ($approvedArticles as $approved) {
            if (isset($statistics[$approved->reviewer_id])) {
                $statistics[$approved->reviewer_id]['total_approved_articles'] = $approved->total_approved_articles;
            } else {
                $statistics[$approved->reviewer_id] = [
                    'total_reviewed_articles' => 0,
                    'total_approved_articles' => $approved->total_approved_articles,
                ];
            }
        }

        return $statistics;
    }
}
