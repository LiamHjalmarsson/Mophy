<?php 

namespace App\Actions\Movie;

use App\Http\Requests\Movie\StoreRequest;
use App\Models\Movie;

class StoreAction 
{
    public function __invoke(StoreRequest $request): Movie
    {
        $validated = $request->validated();

        return Movie::create($validated);
    }
}
