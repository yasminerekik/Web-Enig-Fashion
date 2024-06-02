<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

class pagesController extends Controller
{
    public function home(){
        return view('pages.home');

    }
    public function produits(){
        return view('products.index');
    }
    public function contact(){
        return view('pages.contact');

    }
    public function submitContactForm(Request $request){
        $validatedData = $request->validate([
            'field1' => 'name',
            'field2' => 'email',
        ]);
        return redirect()->route('contact')->with('success', 'votre message a été envoyé avec succès');
    }
    

    
}   

