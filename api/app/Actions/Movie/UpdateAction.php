<?php 

namespace App\Actions\Movie;

use App\Http\Requests\Movie\UpdateRequest;
use App\Models\Movie;

class UpdateAction 
{
    public function __invoke(UpdateRequest $request, Movie $movie): Movie
    {
        $validated = $request->validated();

        $movie->update($validated);

        return $movie;
    }
}
