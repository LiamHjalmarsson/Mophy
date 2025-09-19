<?php 

namespace App\Actions\MovieLike;

use App\Http\Requests\MovieList\UpdateRequest;
use App\Models\MovieList;

class UpdateAction 
{
    public function __invoke(UpdateRequest $request, MovieList $movieList): MovieList
    {
        $validated = $request->validated();

        $movieList->update($validated);

        return $movieList;
    }
}
