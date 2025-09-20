<?php 

namespace App\Actions\Genre;

use App\Http\Requests\Genre\StoreRequest;
use App\Models\Genre;

class StoreAction 
{
    public function __invoke(StoreRequest $request): Genre
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        } else {
            $validated['cover'] = 'defaults/genre-cover.png';
        }

        return Genre::create($validated);
    }
}
