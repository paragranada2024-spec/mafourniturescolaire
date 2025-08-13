<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commande extends Model
{
    // Ajout des nouveaux champs: pack, price, note
    protected $fillable = [
        'name',
        'telephone',
        'ville',
        'status',
        'pack',
        'price',
        'note',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(CommandeItem::class);
    }
}
