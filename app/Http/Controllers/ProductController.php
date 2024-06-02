<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request, $category)
    {
        $query = $request->input('query');//variable d'instance de requet http recupere l'url de l'interface qui contient les produits filtres selon la condition
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
    
        $products = Product::where('categorie', $category)
            ->when($query, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%$search%")
                          ->orWhere('description', 'like', "%$search%")
                          ->orWhere(function ($query) use ($search) {
                              $query->where('name', 'like', "%$search%")
                                    ->where('description', 'like', "%$search%");
                          });
                });
            })
            ->when($minPrice, function ($query, $minPrice) {
                return $query->where('price', '>=', $minPrice);
            })
            ->when($maxPrice, function ($query, $maxPrice) {
                return $query->where('price', '<=', $maxPrice);
            })
            ->get();
    
        return view('products.'.$category, compact('products', 'query', 'minPrice', 'maxPrice'));
    }
    
    
    public function comment(Request $request, Product $product)
    {
        // Validate the request
        $request->validate([
            'comment' => 'nullable|string',
            'rating' => 'nullable|numeric|min:1|max:5',
        ]);

        // Update the product with the new comment and rating
        $product->update([
            'comments' => $request->input('comment'),
            'ratings' => $request->input('rating'),
        ]);

        return redirect()->back()->with('success', 'Comment and rating submitted successfully');
    }
    public function placeOrder(Request $request, Product $product)
{
    
    if (Auth::user()->hasRole('seller') && $product->user_id == Auth::id()) {
        return redirect()->back()->with('error', 'Sellers cannot order their own products.');
    }

    
    $order = new Order([
        'user_id' => Auth::id(),
        'product_id' => $product->id,
        'status' => 'placed', // You can set an initial status
        'total_amount' => $product->price,
        
    ]);

    $order->save();

    // Update product availability or any other necessary actions

    return view('orders.ordersform', compact('product'));

}
    
}
