<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Category\StoreAction;
use App\Actions\Category\UpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Resources\Category\IndexResource;
use App\Http\Resources\Category\ShowResource;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class CategoryContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return IndexResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, StoreAction $action)
    {
        Gate::authorize('create', User::class);

        $category = $action($request);

        return new ShowResource($category);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new ShowResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category, UpdateAction $action)
    {
        Gate::authorize('update', User::class);

        $updatedCategory = $action($request, $category);

        return new ShowResource($updatedCategory); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Gate::authorize('destroy', User::class);

        $category->delete();

        return response()->noContent();
    }
}
