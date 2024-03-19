<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Reviewer extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
    */
    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'reviewers_articles', 'reviewer_id', 'article_id');
    }
}
