<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'user_id',
        'movie_id'
    ];

    public function user (): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }

    public function movie (): BelongsTo 
    {
        return $this->belongsTo(Movie::class);
    }

    public function getCreatedAtFormattedAttribute(): ?string
    {
        return $this->created_at ? Carbon::parse($this->created_at)->format('Y-m-d') : null;
    }
}
