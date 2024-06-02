<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table = 'forms';
    // Spécifiez les champs remplissables
    protected $fillable = [
        'nom', 
        'prenom', 
        'adresse', 
        'contact',
        'feedback', 
        'emoji'];
   
}
