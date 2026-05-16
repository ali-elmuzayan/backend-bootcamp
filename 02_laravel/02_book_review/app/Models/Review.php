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
}
