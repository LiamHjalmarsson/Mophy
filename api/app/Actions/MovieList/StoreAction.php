<?php 

namespace App\Actions\MovieLike;

use App\Http\Requests\MovieList\StoreRequest;
use App\Models\MovieList;
use Illuminate\Support\Facades\Auth;

class StoreAction 
{
    public function __invoke(StoreRequest $request): MovieList
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::id();

        return MovieList::create($validated);
    }
}
