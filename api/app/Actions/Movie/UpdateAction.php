<?php 

namespace App\Actions\Movie;

use App\Http\Requests\Movie\UpdateRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class UpdateAction 
{
    public function __invoke(UpdateRequest $request, Movie $movie): Movie
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            if ($movie->cover && Storage::disk('public')->exists($movie->cover)) {
                Storage::disk('public')->delete($movie->cover);
            }

            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }


        $movie->update($validated);

        return $movie;
    }
}
