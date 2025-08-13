<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeItem;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class CommandeAdminController extends Controller
{
    public function index()
    {
        // récupère toutes les commandes avec items, pack, price et note
        $commandes = Commande::with('items')->latest()->get();

        return Inertia::render('Commandes', [
            'commandes' => $commandes,
        ]);
    }

    public function store(Request $request)
    {
        // validation admin
        $request->validate([
            'name' => 'required|string|max:255',
            'telephone' => 'required|string|max:20',
            'ville' => 'required|string|max:100',
            'pack' => 'required|string|in:eco,plus',
            'price' => 'required|string|max:50',
            'note' => 'nullable|string|max:255',
            'files.*' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:5120',
        ]);

        // création de la commande
        $commande = Commande::create([
            'name' => $request->name,
            'telephone' => $request->telephone,
            'ville' => $request->ville,
            'pack' => $request->pack,
            'price' => $request->price,
            'note' => $request->note,
            'status' => 'pending',
        ]);

        // upload des fichiers
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('commandes', 'public');
                CommandeItem::create([
                    'commande_id' => $commande->id,
                    'image' => $path,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Commande créée avec succès');
    }

    public function markDone($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->status = 'done';
        $commande->save();
    }

    public function cancel($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->status = 'cancelled';
        $commande->save();
    }

    public function destroy($id)
    {
        $commande = Commande::with('items')->findOrFail($id);

        foreach ($commande->items as $item) {
            if (Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $item->delete();
        }

        $commande->delete();

        return response()->json(['message' => 'Commande deleted successfully']);
    }

    public function updateNote(Request $request, $id)
{
    $request->validate([
        'note' => 'nullable|string|max:255',
    ]);

    $commande = Commande::findOrFail($id);
    $commande->note = $request->note;
    $commande->save();

    return response()->json(['message' => 'Note updated successfully']);
}

public function updatePrice(Request $request, $id)
{
    $request->validate([
        'price' => 'required|string|max:50',
    ]);

    $commande = Commande::findOrFail($id);
    $commande->price = $request->price;
    $commande->save();

    return response()->json(['message' => 'Price updated successfully']);
}

}
