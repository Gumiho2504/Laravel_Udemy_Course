<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author'
    ];


    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }


    public function scopeTitle(Builder $query, string $title)
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    public function scopeWithReviewsCount(Builder $query, $from = null, $to = null): Builder | QueryBuilder
    {
        return $query->withCount(['reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)]);
    }

    public function scopePopular(Builder $query, $from = null, $to = null): Builder | QueryBuilder
    {
        return $query->withReviewsCount()
            ->orderBy('reviews_count', 'desc');
    }

    public function scopeWithAvgRating(Builder $query, $from = null, $to = null)
    {
        return $query->withAvg(['reviews' => fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)], 'rating');
    }

    public function scopeHighestRated(Builder $query, $from = null, $to = null): Builder | QueryBuilder
    {

        return $query->withAvgRating()->orderBy('reviews_avg_rating', 'desc');
    }


    public function scopeMinReviews(Builder $query, int $minReviews)
    {
        return $query->having('reviews_count', '>=', $minReviews);
    }

    private function dateRangeFilter(Builder $query, $from, $to)
    {
        if ($from && !$to) {
            $query->where('created_at', '>=', $from);
        } elseif ($to && !$from) {
            $query->where('created_at', '<=', $to);
        } elseif ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }
    }

    public function scopePopularLastMonth(Builder $query): Builder | QueryBuilder
    {
        return $query->popular(now()->subMonth(), now())
            ->highestRated(now()->subMonth(), now())
            ->minReviews(10);
    }

    public function scopePopularLast6Months(Builder $query): Builder | QueryBuilder
    {
        return $query->popular(now()->subMonth(6), now())
            ->highestRated(now()->subMonth(), now(6))
            ->minReviews(10);
    }

    public function scopeHighestRatedLastMonth(Builder $query): Builder | QueryBuilder
    {
        return $query->highestRated(now()->subMonth(), now());
        //->minReviews(2);
    }

    public function scopeHighestRatedLast6Months(Builder $query): Builder | QueryBuilder
    {
        return $query->highestRated(now()->subMonth(6), now());
    }


    protected static function booted()
    {
        static::deleted(fn(Book $book) => cache()->forget('book:' . $book->id));
        static::updated(fn(Book $book) => cache()->forget('book:' . $book->id));
    }
}
