<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Reviewer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'status'
    ];

    /**
     * @return BelongsToMany
    */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, 'authors_articles', 'article_id', 'author_id');
    }

    /**
     * @return BelongsToMany
     */
    public function reviewers(): BelongsToMany
    {
        return $this->belongsToMany(Reviewer::class, 'reviewrs_articles', 'article_id', 'reviewer_id');
    }
}