<?php

namespace App\Http\Controllers\Site\Delivery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class DeliveryController extends Controller
{
    public function postStore(Request $request) {

        try {    
            // Vérifier si l'utilisateur a choisi "Retrait sur place"
            $isPickup = $request->input('delivery_option') === 'pickup';
        
            // Valider les données
            $request->validate([
                'delivery_cost' => 'required|integer',
                'delivery_location' => $isPickup ? 'nullable|string' : 'required|string',
            ]);
        
            // Stocker les détails dans la session
            session()->put('delivery_cost', $request->input('delivery_cost'));
            session()->put('delivery_location', $isPickup ? 'Retrait sur place' : $request->input('delivery_location'));
        
            // Rediriger vers la page du bon de commande
            return redirect()->route('Site-OrderGetShow'); 
        } catch (\Exception $e) {
            // Message d'erreur
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la validation de la livraison.' . $e->getMessage());
        }

    }    
           
}
