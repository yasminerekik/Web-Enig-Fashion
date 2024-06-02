<?php

namespace App\Http\Controllers;
use App\Events\OrderStatusUpdated;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    public function placeOrder(Request $request, Product $product)
    {
        
        // Check if the user is a seller and prevent them from ordering their own product
        if (Auth::user()->hasRole('seller') && $product->user_id == Auth::id()) {
            return redirect()->back()->with('error', 'Sellers cannot order their own products.');
        }
        
        // Create a new order
        $order = new Order([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'status' => 'completed', // You can set an initial status
            'total_amount' => $product->price * $request->input('quantity'),            
        ]);

        // Update product availability or any other necessary actions

        return view('order.orderform', compact('product'));    }
        public function orderHistory()
{
    $userOrders = Order::where('user_id', Auth::id())->get();

    return view('order.history', compact('userOrders'));
}
public function submitOrder(Request $request, Product $product)
{
    // Validate the order form data
    $request->validate([
        'quantity' => 'required|numeric|min:1',
        // Add other validation rules for order details
    ]);

    // Initialize totalAmount variable
    $totalAmount = 0;

    // Check if the product has a promotion
    if ($product->promotion_percentage && $product->promotion_start_date && $product->promotion_end_date) {
        // Check if the promotion is currently active
        if ($product->promotion_start_date <= now() && $product->promotion_end_date >= now()) {
            // Calculate the discounted price
            $discountedPrice = $product->price - ($product->price * ($product->promotion_percentage / 100));
            // Recalculate the total amount with the discounted price
            $totalAmount = $discountedPrice * $request->input('quantity');
        } else {
            // Promotion is expired, revert to regular price
            $totalAmount = $product->price * $request->input('quantity');
        }
    } else {
        // Calculate the total amount using the product price and quantity
        $totalAmount = $product->price * $request->input('quantity');
    }
    
    // Create a new order with the validated data
    $order = new Order([
        'user_id' => Auth::id(),
        'product_id' => $product->id,
        'status' => 'completed',  // Set initial status
        'total_amount' => $totalAmount,
        'quantity' => $request->input('quantity'), // Save the quantity with the order
        // Add other order details as needed
    ]);

    $order->save();

    // Update product availability or any other necessary actions

    // Redirect to the order history view
    return redirect()->route('order.history')->with('success', 'Order placed successfully.');
}



public function markFormAsSeen(Request $request)
{
    // Récupérer les IDs des formulaires marqués comme vus
    $seenFormIds = $request->input('seen_forms', []);
    
    // Supprimer les formulaires marqués comme vus de la base de données
    Form::whereIn('id', $seenFormIds)->delete();
    
    // Rediriger l'utilisateur vers la page de tableau de bord ou une autre page appropriée
    return redirect()->back()->with('success', 'Les formulaires ont été marqués comme vus avec succès.');
}


    // Méthode pour supprimer une commande
    public function delete(Order $order)
    {
        // Supprimez la commande
        $order->delete();

        // Redirigez avec un message de succès
        return redirect()->back()->with('success', 'Order deleted successfully.');
    }
    public function create()
{
    return view('order.create');
}
    // Méthode pour traiter le formulaire soumis
    public function store(Request $request)
    {
        // Validez les données du formulaire ici si nécessaire

        // Créez un nouveau formulaire avec les données du formulaire
        $form = new Form();
        $form->nom = $request->input('nom');
        $form->prenom = $request->input('prenom');
        $form->adresse = $request->input('adresse');
        $form->contact = $request->input('contact');
        $form->feedback = $request->input('feedback');
        $form->emoji = $request->input('emoji');
        $form->save();

        // Affichez un message de confirmation
        return redirect()->back()->with('success', 'Your order has been successfully sent! We will contact you soon.'); //session
    }

    
}
