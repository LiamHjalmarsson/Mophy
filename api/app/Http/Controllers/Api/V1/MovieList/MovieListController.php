<?php

namespace App\Http\Controllers\Api\V1\MovieList;

use App\Http\Controllers\Controller;
use App\Http\Resources\MovieList\IndexResource;
use App\Models\MovieList;
use Illuminate\Http\Request;

class MovieListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lists = MovieList::with('user')->paginate(25);

        return IndexResource::collection($lists);
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
