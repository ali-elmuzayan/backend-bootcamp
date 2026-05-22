<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory; 
    
    protected $guarded = []; 


	// ----------------------------------------------------------------
    // --- Relationships
   	// ----------------------------------------------------------------   
    public function Reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

	// ----------------------------------------------------------------
    // --- local query  scope: 
   	// ----------------------------------------------------------------


    // fetch books By The Title 
	public function scopeTitle(Builder $query, string $title):Builder
	{
		return	$query->where('title', 'LIKE', "%$title%"); 
	}
		
	
	//  Popular Books
	public function scopePopular(Builder $query, $from = null, $to = null) : Builder | QueryBuilder {
		return $query->withCount([
			'reviews'=> fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
		])	
			->orderBy('reviews_count', 'desc');
	}
	

	// The Highest Rated
	public function scopeHighestRated(Builder $query,  $from = null, $to = null): Builder| QueryBuilder
	{
		return $query->withAvg([
			'reviews'=> fn(Builder $q) => $this->dateRangeFilter($q, $from, $to)
			], 'rating')
				->orderBy('reviews_avg_rating', 'desc'); 
	}
	

	// books with min amount of reviews (should use popular)
	public function scopeMinReviews(Builder $query, int $minReviews): Builder| QueryBuilder
	{
		return $query->having('reviews_count', '>=', $minReviews);
	}
	
	
	
	// Popular Last Month && Popular Last 6 Months
	public function scopePopularLastMonth(Builder $query): Builder|QueryBuilder
	{
		return $query->popular(now()->subMonth(), now())
				->highestRated(now()->subMonth(), now())
				->minReviews(2);
	} 
	
	public function scopePopularLast6Month(Builder $query): Builder|QueryBuilder
	{
		return $query->popular(now()->subMonths(6), now())
				->highestRated(now()->subMonths(6), now())
				->minReviews(5);
	} 	
	
	
	// ---- HIghest Rated && Highest Rated Last 6 Months
	public function scopeHighestRatedLastMonth(Builder $query): Builder|QueryBuilder
	{
		return $query->HighestRated(now()->subMonth(), now())
				->popular(now()->subMonth(), now())
				->minReviews(2);
	} 
	
	public function scopeHighestRatedLast6Month(Builder $query): Builder|QueryBuilder
	{
		return $query->highestRated(now()->subMonths(6), now())
				->popular(now()->subMonths(6), now())
				->minReviews(5);
	} 
	
	
	// ---------------------------------------------------------------
	// ---- Reusable Method -------------
	// ---------------------------------------------------------------
	private function dateRangeFilter(Builder $query, $from = null, $to = null) 
	{
				if ($from && !$to) {
						$query->where('created_at', '>=', $from); 
					} elseif (!$from && $to) {
						$query->where('created_at', '<=', $to); 
					} elseif ( $from && $to) {
						$query->whereBetween('created_at', [$from, $to]); 
					}
	}

}
