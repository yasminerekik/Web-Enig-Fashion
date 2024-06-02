<?php

namespace App\Http\Controllers;
use App\Mail\ContactMessageCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Contact; // Make sure to import the Contact model

class ContactController extends Controller
{
    public function storeContact(Request $request)
    {
        $request->validate([
            'nom' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $contact = new Contact([
            'nom' => $request->input('nom'),
            'email' => $request->input('email'),
            'message' => $request->input('message'),
        ]);

        $contact->save();

        $request->session()->flash('success', 'Your complaint has been successfully sent !');
        
        // Redirection vers la page de contact avec le message de succès
        return redirect()->route('contact');
    }
}
