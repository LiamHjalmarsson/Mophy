<?php 

namespace App\Actions\Genre;

use App\Http\Requests\Genre\UpdateRequest;
use App\Models\Genre;
use Illuminate\Support\Facades\Storage;

class UpdateAction 
{
    public function __invoke(UpdateRequest $request, Genre $genre): Genre
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            if ($genre->cover && Storage::disk('public')->exists($genre->cover)) {
                Storage::disk('public')->delete($genre->cover);
            }

            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $genre->update($validated);

        return $genre;
    }
}
