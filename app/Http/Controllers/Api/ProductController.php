<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * PUBLIC: Display a listing of all products.
     */
    public function index()
    {
        // Eager load the category for efficiency
        return Product::with('category')->paginate(15);
    }

    /**
     * ADMIN-ONLY: Store a newly created product.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|min:3',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }

        $product = Product::create($validatedData);

        return response()->json($product, 201);
    }

    /**
     * PUBLIC: Display a single product.
     */
    public function show(Product $product)
    {
        // Load the category relationship for this single product
        return $product->load('category');
    }

    /**
     * ADMIN-ONLY: Update an existing product.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'category_id' => 'sometimes|required|exists:categories,id',
            'name' => 'sometimes|required|string|min:3',
            'price' => 'sometimes|required|numeric|min:0',
            'quantity' => 'sometimes|required|integer|min:0',
            'description' => 'sometimes|required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Store the new one
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }

        $product->update($validatedData);

        return response()->json($product);
    }

    /**
     * ADMIN-ONLY: Delete a product.
     */
    public function destroy(Product $product)
    {
        // Delete the associated image file if it exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json(null, 204);
    }
}