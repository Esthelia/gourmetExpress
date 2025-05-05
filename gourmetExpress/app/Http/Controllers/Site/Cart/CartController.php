<?php

namespace App\Http\Controllers\Site\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function getShow() {

        $cartItems = session()->get('cartItems', []);
        $cartCount = array_sum(array_column($cartItems, 'quantity'));
    
        $total = 0;
        foreach ($cartItems as $cartItem) {
            $total += ($cartItem['quantity'] * ($cartItem['price']) + $cartItem['accompaniment']);
        }
        return view('pages.site.cart.show', compact('cartItems', 'total', 'cartCount'));
    }
    
    public function postAdd(Request $request, $id) {
        // Récupérer le produit
        $product = Product::find($id);
    
        // Vérifier si le produit existe
        if (!$product) {
            return redirect()->back()->with('error', 'Produit non trouvé.');
        }
    
        // Valider la quantité et l'accompagnement
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'accompaniment' => 'required|integer|string', // Validation pour l'accompagnement
        ]);
    
        // Récupérer le panier de la session
        $cartItems = session()->get('cartItems', []);
    
        // Définir les prix des accompagnements
        $accompanimentPrices = [
            1 => 500,  // Attièké
            2 => 1000, // Riz Cartonnés
            3 => 500,  // Riz Normal à la vapeur
            4 => 1000, // Alloco
            5 => 1000, // Frite
        ];
        $accompanimentPrice = $accompanimentPrices[$request->accompaniment] ?? 0;
    
        // Calculer le prix total pour un produit incluant l'accompagnement
        $unitPrice = $product->price;
        $totalPrice = ($unitPrice * $request->quantity)  + $accompanimentPrice;
    
        // Vérifier si le produit est déjà dans le panier
        if (isset($cartItems[$id])) {
            // Mettre à jour la quantité et le total
            $cartItems[$id]['quantity'] += $request->quantity;
            $cartItems[$id]['total'] = ($unitPrice + $accompanimentPrice) * $cartItems[$id]['quantity'];
        } else {
            // Ajouter un nouveau produit au panier
            $cartItems[$id] = [
                "image" => $product->image,
                "name" => $product->name,
                "quantity" => $request->quantity,
                "accompaniment" => $accompanimentPrice,
                'accompaniment' => $request->input('accompaniment', 'Aucun'),
                "price" => $unitPrice, // Prix de base sans accompagnement
                "total" => $totalPrice,
            ];
        }
    
        // Mettre à jour la session avec le nouveau panier
        session()->put('cartItems', $cartItems);
    
        return redirect()->route('Site-AccueilGetShow')->with('success', 'Produit ajouté au panier.');
    }
    
    
    
    public function getRemove($id) {
        $cartItems = session()->get('cartItems', []);

        if (isset($cartItems[$id])) {
            unset($cartItems[$id]);
            session()->put('cartItems', $cartItems);
        }
    
        return redirect()->route('Site-AccueilGetShow')->with('success', 'Produit supprimé du panier.');
    }
    
}
