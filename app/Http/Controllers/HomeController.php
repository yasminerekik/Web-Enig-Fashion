<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        // Share userRole variable with all views
        View::composer('home', function ($view) {
            $view->with('userRole', auth()->check() ? auth()->user()->role : null);
        });
    }

    
    public function index()
{
    $user = Auth::user();
    $userRole = $user ? $user->role : null;

    return view('home', compact('userRole'));
}
    
}