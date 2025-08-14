<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommandeController extends Controller
{
    // عرض الصفحة مع جميع commandes وعناصرها
    public function index()
    {
        $commandes = Commande::with('items')->get();

        return Inertia::render('CommandePage', [
            'commandes' => $commandes,
        ]);
    }

    // استلام البيانات + رفع الملفات + حفظهم
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'ville' => 'required|string|max:100',
            'pack' => 'required|in:eco,plus', // validation dyal pack
            'files.*' => 'file|mimes:jpeg,png,jpg,pdf,webp|max:2048',
        ]);

        // Création commande
        $commande = Commande::create([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'ville' => $request->ville,
            'pack' => $request->pack, // khlli pack li ikhtar user
        ]);

        // Upload des fichiers
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('uploads', 'public');
                $commande->items()->create([
                    'image' => $path,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Commande ajoutée avec succès');
    }
}

