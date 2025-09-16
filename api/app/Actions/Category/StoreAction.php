<?php 

namespace App\Actions\Category;

use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;

class StoreAction 
{
    public function __invoke(StoreRequest $request): Category
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        } else {
            $validated['cover'] = 'defaults/movie-cover.png';
        }

        return Category::create($validated);
    }
}
