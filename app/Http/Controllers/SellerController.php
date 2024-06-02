<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Form;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function dashboard()
{
    $user = auth()->user();
    $products = Product::where('user_id', $user->id)->get();
    $orders = Order::all();
    // Récupérer tous les formulaires
    $forms = Form::all();

    return view('seller.dashboard', compact('products','orders','forms'));
}
    public function storeProduct(Request $request)
    {
        // Valider la requête
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'categorie' => 'required|in:women,men,kids', // Assurer que la catégorie est valide
            'promotion_percentage' => 'nullable|numeric|min:0|max:100',
            'promotion_start_date' => 'nullable|date',
            'promotion_end_date' => 'nullable|date|after_or_equal:promotion_start_date',
        ]);

        $user = auth()->user();

        // Créer un nouveau produit avec les données de promotion
        $product = new Product([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'user_id' => $user->id,
            'categorie' => $request->input('categorie'),
            'promotion_percentage' => $request->input('promotion_percentage'),
            'promotion_start_date' => $request->input('promotion_start_date'),
            'promotion_end_date' => $request->input('promotion_end_date'),
        ]);

        if ($request->hasFile('image')) {
            // Enregistrer l'image et ajouter son chemin au produit
            $product->image_path = $request->file('image')->store('product_images', 'public');
        }
        $product->save();

        // Construire la route de redirection en fonction de la catégorie
        $redirectRoute = 'products.category';

        return redirect()->route($redirectRoute, ['category' => $request->input('categorie')])->with('success', 'Product added successfully');
    }

    public function updateProduct(Request $request, Product $product)
    {
        if ($product->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized access to update this product');
        }

        // Validate the request
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'promotion_percentage' => 'nullable|numeric|min:0|max:100',
            'promotion_start_date' => 'nullable|date',
            'promotion_end_date' => 'nullable|date|after_or_equal:promotion_start_date',
        ]);

        // Update the product, including the image if provided
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'promotion_percentage' => $request->input('promotion_percentage'),
            'promotion_start_date' => $request->input('promotion_start_date'),
            'promotion_end_date' => $request->input('promotion_end_date'),
        ]);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            // Save the new image and update the image_path attribute
            $product->image_path = $request->file('image')->store('product_images', 'public');
            $product->save();
        }

        return redirect()->back()->with('success', 'Product updated successfully');
    }

    public function deleteProduct(Product $product)
    {
        if ($product->user_id != Auth::id()) {
            // Unauthorized access, handle it accordingly (e.g., redirect)
            return redirect()->back()->with('error', 'Unauthorized access to delete this product');
        }
        // Delete the product
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully');
    }
}
