<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ArticleApprovalService;
use App\Services\EloquentArticleApprovalService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ArticleApprovalService::class, EloquentArticleApprovalService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
