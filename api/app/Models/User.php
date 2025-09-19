<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'age',
        'country',
        'bio',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function movieLikes(): HasMany
    {
        return $this->hasMany(MovieLike::class);
    }

    public function movieLists(): HasMany
    {
        return $this->hasMany(MovieList::class);
    }

    public function commentLikes(): HasMany
    {
        return $this->hasMany(CommentLike::class);
    }

    public function watcheds(): HasMany
    {
        return $this->hasMany(Watched::class);
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    // Querys 

    public function watchedMovies(): BelongsToMany
    {
        $query = $this->belongsToMany(Movie::class, 'watcheds');
        
        $query->withPivot('watched_at');

        $watched = $query->withTimestamps();

        return $watched;
    }

    public function watchLaterMovies(): BelongsToMany
    {
        $query = $this->belongsToMany(Movie::class, 'watch_laters');
        
        $watchLater = $query->withTimestamps();

        return $watchLater;
    }
}
