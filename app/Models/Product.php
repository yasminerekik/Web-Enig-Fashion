<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'user_id',
        'comments',
        'ratings',
        'categorie', // Ajoutez cette ligne pour inclure la nouvelle colonne "categorie"
        'promotion_percentage', // Nouveau champ pour le pourcentage de réduction
        'promotion_start_date', // Nouveau champ pour la date de début de la promotion
        'promotion_end_date',   // Nouveau champ pour la date de fin de la promotion
    ];
}
