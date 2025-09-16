<?php 

namespace App\Actions\Category;

use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class UpdateAction 
{
    public function __invoke(UpdateRequest $request, Category $category): Category
    {
        $validated = $request->validated();

        if ($request->hasFile('cover')) {
            if ($category->cover && Storage::disk('public')->exists($category->cover)) {
                Storage::disk('public')->delete($category->cover);
            }

            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        }

        $category->update($validated);

        return $category;
    }
}
