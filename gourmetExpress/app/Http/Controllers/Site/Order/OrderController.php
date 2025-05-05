<?php

namespace App\Http\Controllers\Site\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class OrderController extends Controller
{
        public function getShow(Request $request) {


        $cartItems = session()->get('cartItems', []);
        $cartCount = array_sum(array_column($cartItems, 'quantity'));

        $total = 0;
        foreach ($cartItems as $cartItem) {
            $total += ($cartItem['quantity'] * $cartItem['price']) + $cartItem['accompaniment'];
        }

        $deliveryCost = session()->get('delivery_cost', 0);
        $deliveryLocation = session()->get('delivery_location', 'Non spécifié');
        $finalTotal = $total + $deliveryCost;

    return view('pages.site.commande.show', compact('cartItems', 'cartCount', 'total', 'deliveryCost', 'deliveryLocation', 'finalTotal'));
      }

      public function getIndex()
      {
          $orders = Order::all();
          return view('pages.site.commande.index', compact('orders'));
      }
  
      public function postStore() {
        
            if (!auth()->check()) {
                return redirect()->route('Site-OrderGetShow')->with('error', 'Vous devez être connecté pour passer une commande.');
            }

                // Récupérer les articles du panier
                $cartItems = session()->get('cartItems', []);
                $total = 0;
                $accompaniments = session()->get('accompaniment', []); // <-- Placez cette 
                $deliveryFee = session()->get('deliveryFee', 0); // Supposons que la livraison est stockée dans la session

                // Calculer le total en tenant compte des quantités et des accompagnements
                foreach ($cartItems as $cartItem) {
                    $itemTotal = ($cartItem['quantity'] * $cartItem['price']) + ($cartItem['accompaniment'] ?? 0);
                    $total += $itemTotal;
                }

                // Ajouter les frais de livraison
                $total += $deliveryFee;

                // Créer la commande
                $order = Order::create([
                    'user_id' => auth()->id(),
                    'total' => $total,
                    
                ]);

                // Ajouter les articles à la commande
                foreach ($cartItems as $id => $cartItem) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $id,
                        'quantity' => $cartItem['quantity'],
                        'price' => $cartItem['price'],
                        'accompaniment' => $cartItem['accompaniment'] ?? 0
                    ]);
                }

                

                // Générer la facture PDF
                $pdf = Pdf::loadView('pages.site.commande.invoice', [
                    'order' => $order,
                    'cartItems' => $cartItems,
                    'accompaniment' => $accompaniments, // Utilisez le pluriel ici
                    'total' => $total,
                    'deliveryFee' => $deliveryFee,
                ]);

                // Définir le nom du fichier PDF et le chemin
                $pdfFilename = 'facture-' . time() . '.pdf';

                // Enregistrer le PDF sur le serveur
                $pdfPath = storage_path('app/public/' . $pdfFilename);
                $pdf->save($pdfPath);

                // Vider le panier
                session()->forget('cartItems');
                session()->forget('accompaniments');
                session()->forget('deliveryFee');

                // Télécharger le PDF
                return redirect()->route('Site-OrderGetInvoice',  ['id' => $order->id]);

            
        }
     
      
      public function getInvoice($id) {

        $order = Order::with('orderItems.product')->findOrFail($id);

            // Récupérez les détails de livraison depuis la session
            $deliveryCost = session()->get('delivery_cost', 'Gratuit');
            $deliveryLocation = session()->get('delivery_location', 'Retrait sur place');
            $cartCount = session()->get('cart_count', 0); // Assurez-vous que cette valeur est définie
            
            $total = $order->total; // Total des plats
            $finalTotal = $total + $deliveryCost; // Montant total à régler

            return view('pages.site.commande.invoice', compact('order', 'deliveryCost', 'deliveryLocation', 'cartCount', 'total', 'finalTotal'));
      }


      public function downloadInvoice($id)
        {
            // Récupérer la commande avec les éléments associés
            $order = Order::with('orderItems.product')->findOrFail($id);

            // Récupérer les détails de livraison depuis la session
            $deliveryCost = session()->get('delivery_cost', 'Gratuit');
            $deliveryLocation = session()->get('delivery_location', 'Non spécifié');
            $cartCount = session()->get('cart_count', 0); // Assurez-vous que cette valeur est définie

            // Calculer le total
            $total = $order->total; // Total des plats
            $finalTotal = $total + $deliveryCost; // Montant total à régler

            // Générer le PDF
            $pdf = Pdf::loadView('pages.site.commande.pdf', [
                'order' => $order,
                'deliveryCost' => $deliveryCost,
                'deliveryLocation' => $deliveryLocation,
                'cartCount' => $cartCount,
                'total' => $total,
                'finalTotal' => $finalTotal,
            ]);

            // Définir le nom du fichier PDF
            $pdfFilename = 'facture-' . $order->id . '.pdf';

            // Télécharger le PDF
            return $pdf->download($pdfFilename);
        }


      public function postDestroy($id )
        {
            $order = Order::findOrFail($id);

            if ($order) {
            $order->delete();
            }

            return redirect()->route('Site-OrderGetIndex');
            
        }
  
}
