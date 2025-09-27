<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the public-facing homepage with products and categories.
     */
    public function index()
    {
        // Eager load the 'category' relationship for products
        $products = Product::with('category')->latest()->get();
        $categories = Category::all();

        return view('home', compact('products', 'categories'));
    }

    public function myOrders()
    {
        // Fetch orders belonging only to the current user.
        // Eager load the items and the product for each item.
        $orders = Order::where('user_id', Auth::id())
            ->with('items.product')
            ->latest()
            ->get();

        return view('my-orders', compact('orders'));
    }

    public function buyNow(Product $product)
    {
        // 1. Check if there is enough stock
        if ($product->quantity < 1) {
            return redirect()->route('home')->with('error', 'Sorry, this product is out of stock.');
        }

        // 2. Create the main Order record
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $product->price,
            'status' => 'pending', // Default status
        ]);

        // 3. Create the OrderItem record
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1, // One item at a time
            'price' => $product->price,
        ]);

        // 4. Reduce the product's stock
        $product->decrement('quantity', 1);

        // 5. Redirect the user to their "My Orders" page with a success message
        return redirect()->route('my-orders')->with('success', 'Order placed successfully!');
    }
}
