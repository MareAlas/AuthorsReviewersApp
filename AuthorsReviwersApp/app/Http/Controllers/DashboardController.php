<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * Get all articles
     *
     * @return view
     */
    public function index()
    {
        $articles = Article::with('authors')->get();
        return view('dashboard', compact('articles'));
    }

    /**
     * Get articles submitted by the authenticated author.
     *
     * @return \Illuminate\Http\Response
     */
    public function authorArticles()
    {
        $user = auth()->user();
        $articles = $user->author->articles;
        return response()->json($articles);
    }

    /**
     * Get statistics for the authenticated reviewer.
     *
     * @return \Illuminate\Http\Response
     */
    public function reviewerStatistics()
    {
        $user = auth()->user();
        $statistics = [
            'total_reviewed' => $user->reviewer->articles()->count(),
            'approved' => $user->reviewer->articles()->where('status', 'approved')->count(),
            'rejected' => $user->reviewer->articles()->where('status', 'rejected')->count(),
        ];

        return response()->json($statistics);
    }
}