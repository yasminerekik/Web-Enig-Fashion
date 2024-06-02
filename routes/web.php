<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ContactController;


// Routes accessibles sans authentification
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    } else {
        return view('welcome');
    }
});
// Routes nécessitant une authentification
Route::middleware('auth')->group(function () {
    Route::get('/home', [PagesController::class, 'home'])->name('home');
    Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
    Route::post('/contact-submit', [ContactController::class, 'storeContact'])->name('contact.submit');
    Route::get('/seller/seller.home', function () {
        return view('seller.home');
    });
    Route::get('/seller/seller.contact', function () {
        return view('seller.contact');
    });
    Route::get('/products/{category}', [ProductController::class, 'index'])->name('products.category');
    Route::get('/seller/dashboard', [SellerController::class, 'dashboard'])->name('seller.dashboard');
    Route::post('/products/{product}/comment', [ProductController::class, 'comment'])->name('products.comment');
    Route::post('/seller/products', [SellerController::class, 'storeProduct'])->name('seller.products.store');
    Route::put('/seller/products/{product}', [SellerController::class, 'updateProduct'])->name('seller.products.update');
    Route::delete('/seller/products/{product}', [SellerController::class, 'deleteProduct'])->name('seller.products.delete');
    Route::post('/orders/place/{product}', [OrderController::class, 'placeOrder'])->name('orders.place');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/order-history', [OrderController::class, 'orderHistory'])->name('order.history');
    Route::post('/submit-order/{product}', [OrderController::class, 'submitOrder'])->name('submit.order');
    Route::get('/orders/history', [OrderController::class, 'orderHistory'])->name('orders.history');
    Route::post('/mark-form-as-seen', [OrderController::class, 'markFormAsSeen'])->name('mark-form-as-seen');
    Route::delete('/orders/{order}', [OrderController::class, 'delete'])->name('orders.delete');
    Route::get('/passer-commande', [OrderController::class, 'create'])->name('order.create');
    Route::post('/form/store', [OrderController::class, 'store'])->name('form.store');
    Route::match(['get', 'post'], 'orders/place/seller.contact', function () {
        return view('seller.contact');
    });
    Route::match(['get', 'post'], 'orders/place/seller.home', function () {
        return view('seller.home');
    });

});

Auth::routes();
