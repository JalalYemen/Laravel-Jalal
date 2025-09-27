<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * PUBLIC: Display a listing of all categories.
     */
    public function index()
    {
        return Category::paginate(15);
    }

    /**
     * ADMIN-ONLY: Store a newly created category.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:categories|max:255',
        ]);

        $category = Category::create($validatedData);

        return response()->json($category, 201); 
    }

    /**
     * PUBLIC: Display a single category.
     */
    public function show(Category $category)
    {
        return $category;
    }

    /**
     * ADMIN-ONLY: Update an existing category.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($category->id),
            ],
        ]);

        $category->update($validatedData);

        return response()->json($category);
    }

    /**
     * ADMIN-ONLY: Delete a category.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(null, 204);
    }
}