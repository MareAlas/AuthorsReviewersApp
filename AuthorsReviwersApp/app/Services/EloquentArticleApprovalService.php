<?php

namespace App\Services;

use App\Models\Article;
use App\Models\Reviewer;
use App\Enums\ArticleStatus;
use Illuminate\Support\Facades\DB;

class EloquentArticleApprovalService implements ArticleApprovalService
{
    public function approveArticle(Article $article, int $reviewerId)
    {
        DB::beginTransaction();

        try {
            $reviewer = Reviewer::findOrFail($reviewerId);

            $rejectedReviewersCount = $article->reviewers()->wherePivot('status', ArticleStatus::REJECTED)->count();

            if ($rejectedReviewersCount > 0) {
                throw new \Exception('The article has been rejected by at least one reviewer.');
            }

            $article->reviewers()->attach($reviewer->id, ['status' => ArticleStatus::APPROVED]);
            $article->update(['status' => ArticleStatus::APPROVED]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function rejectArticle(Article $article, int $reviewerId)
    {
        DB::beginTransaction();

        try {
            $reviewer = Reviewer::findOrFail($reviewerId);

            $article->update(['status' => ArticleStatus::REJECTED]);
            $article->reviewers()->attach($reviewer->id, ['status' => ArticleStatus::REJECTED]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }

    public function publishArticle(Article $article, int $reviewerId)
    {
        DB::beginTransaction();

        try {
            if ($article->status !== ArticleStatus::APPROVED) {
                throw new \Exception('The article is not approved.');
            }
            $article->update(['status' => ArticleStatus::PUBLISHED]);

            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollback();
            return false;
        }
    }
}