
<?php
namespace App\Actions\Movie\Favorite;

use App\Http\Requests\Movie\Favorite\StoreRequest;
use App\Models\Favorite;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class UpdateAction
{
    public function __invoke(StoreRequest $request, Movie $movie): Favorite
    {
        $validated = $request->validated();

        return Favorite::updateOrCreate(
            [
                'user_id'  => Auth::id(),
                'movie_id' => $movie->id,
            ],
            [
                'is_public' => $validated['is_public'] ?? true,
            ]
        );
    }
}
