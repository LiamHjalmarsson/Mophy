<?php

namespace App\Http\Controllers\Api\V1\Movie;

use App\Http\Controllers\Controller;
use App\Http\Resources\Movie\Reviews\IndexResource;
use App\Models\Movie;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Movie $movie)
    {
        $reviews = $movie->reviews()->with('user')->paginate(25);

        return IndexResource::collection($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
