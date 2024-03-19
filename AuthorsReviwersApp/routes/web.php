<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewerDashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/articles/{article}/approve', [ReviewerDashboardController::class, 'approveArticle'])->name('article.approve');
    Route::put('/articles/{article}/reject', [ReviewerDashboardController::class, 'rejectArticle'])->name('article.reject');
    Route::post('/articles/{article}/publish', [ReviewerDashboardController::class, 'publishArticle'])->name('articles.publish');
    Route::get('/reviewer-statistics', 'ReviewerStatisticsController@index')->name('reviewer.statistics');

});

require __DIR__.'/auth.php';
