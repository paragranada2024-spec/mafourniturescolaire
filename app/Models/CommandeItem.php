<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommandeItem extends Model
{
    use HasFactory;

    protected $fillable = ['commande_id', 'image'];

    // اليد اللي كتحرك الظل
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }
}
