<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory; 
    
    protected $guarded = []; 
    // --- Relationships ------
    public function book(): BelongsTo 
    {
        return $this->belongsTo(Book::class);
    }

    public static function booted() 
    {
        static::updated(fn ($review) => cache()->forget('book:' . $review->book_id) );
        static::deleted(fn ($review) => cache()->forget('book:' . $review->book_id) );
        static::created(fn ($review) => cache()->forget('book:' . $review->book_id) );
    }
}
