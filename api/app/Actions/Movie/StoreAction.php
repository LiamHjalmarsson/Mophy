<?php 

namespace App\Actions\Movie;

use App\Http\Requests\Movie\StoreRequest;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class StoreAction 
{
    public function __invoke(StoreRequest $request): Movie
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        } else {
            $validated['cover'] = 'defaults/movie-cover.png';
        }

        $validated['created_by'] = Auth::id();

        return Movie::create($validated);
    }
}
