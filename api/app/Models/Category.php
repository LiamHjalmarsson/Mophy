<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'cover'
    ];

    public function movies (): BelongsToMany 
    {
        return $this->belongsToMany(Movie::class, 'category_movie');
    }

    public function getCoverUrlAttribute(): string
    {
        return $this->coverUrl('categories', 'category-cover.png');
    }
}
