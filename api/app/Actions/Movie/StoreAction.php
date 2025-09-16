<?php 

namespace App\Actions\Movie;

use App\Http\Requests\Movie\StoreRequest;
use App\Models\Movie;

class StoreAction 
{
    public function __invoke(StoreRequest $request): Movie
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        return Movie::create($validated);
    }
}
