    




public function postAdd(Request $request, $id)
    {
       try {
            $product = Product::find($id);

            if (!$product) {
                return redirect()->back()->with('error', 'Produit non trouvé');
            }
    
            $cart = session()->get('cart', []);
    
            $accompanimentPrice = $request->input('accompaniment_price', 0);
            $accompanimentQuantity = $request->input('accompaniment_quantity', 0);
    
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] += 1;
                $cart[$id]['accompaniment_quantity'] += $accompanimentQuantity;
            } else {
                $cart[$id] = [
                    'image' => $product->image,
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'accompaniment_price' => $accompanimentPrice,
                    'accompaniment_quantity' => $accompanimentQuantity,
                    'accompaniment_price' => $request->input('accompaniment', 'Aucun'),
                ];
            }
    
            session()->put('cart', $cart);
            
            Log::info('Cart updated: ', $cart); // Ajout de la journalisation
    
            return redirect()->route('Site-CartGetShow')->with('success', 'Produit ajouté au panier');
        }  catch (\Exception $e) {
            return redirect()->back()->with('error', 'une erreur est survenu lors de l\ajout au panier'. $e->getMessage());  
        }
    }

    public function getShow()
    {
        $cart = session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));
    
        $total = 0;
        foreach ($cart as $cartItem) {
            $total += $cartItem['quantity'] * ($cartItem['price'] + $cartItem['accompaniment_price']);
        }
        return view('pages.site.cart.show', compact('cart', 'total', 'cartCount'));
    }


    public function getRemove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('Site-AccueilGetShow')->with('success', 'Produit supprimé du panier');
    }

    
    public function getClear() {

        session()->forget('cart');

        return redirect()->route('Site-CartGetShow')->with('success', 'Panier vidé avec succès'); 
    }












<section class="h-100 h-custom" style="background-color: #d2c9ff;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12">
        <div class="card card-registration card-registration-2" style="border-radius: 15px; margin-top:50px;">
          <div class="card-body p-0">
            <div class="row g-0">
              <!-- Colonne pour afficher les détails des articles -->
              <div class="col-lg-8">
                 
                  <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0">Plat ajouté au panier</h1>
                      <h6 class="mb-0 text-muted">{{ $cartCount }} plat(s) ajouté(s)</h6>
                    </div>

                    @foreach ($cartItems as $id => $cartItem)
                      <div class="d-flex align-items-center mb-4">
                        <div class="me-3">
                          <img src="{{ asset('storage/' . $cartItem['image']) }}" class="img-fluid" style="max-width: 100px;">
                        </div>
                        <div class="me-3">
                          <h6 class="text-muted">Plat Ajouter</h6>
                          <h6 class="mb-0">{{ $cartItem['name'] }}</h6>
                        </div>
                        <div class="me-3">
                          <h6 class="text-muted">Prix Unitaire</h6>
                          <h6 class="mb-0">{{ $cartItem['price'] }} FCFA</h6>
                        </div>
                        <div class="me-3">
                          <h6 class="text-muted">Quantité</h6>
                          <h6 class="mb-0">{{ $cartItem['quantity'] }}</h6>
                        </div>
                        <div class="me-3">
                          <h6 class="text-muted">Accompagnement</h6>
                          <h6 class="mb-0">{{ $cartItem['accompaniment_price'] }} ({{ $cartItem['accompaniment_price'] }} FCFA)</h6>
                        </div>
                        <div>
                          <a href="#" data-bs-toggle="modal" data-bs-target="#modal-{{ $id }}" class="text-muted">
                            <i class="bi bi-x-square-fill"></i>
                          </a>
                          
                          <!-- Modal -->
                          <div class="modal fade" id="modal-{{ $id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-{{ $id }}-label" aria-hidden="true">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h1 class="modal-title btn btn-danger fs-5" id="modal-{{ $id }}-label">Alerte</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <p style="margin-right:50px;">
                                            Vous êtes sur le point de supprimer une commande de votre panier. Cette action est irréversible et les détails de la commande seront définitivement supprimés. Êtes-vous sûr de vouloir continuer ?
                                          </p>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non, j'annule</button>
                                          <a href="{{ route('Site-CartGetRemove', $id) }}" class="btn btn-primary">Oui, je veux supprimer la commande</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
                      <hr class="my-4">
                    @endforeach

                    <div class="pt-5">
                      <a class="btn btn-primary" href="{{ route('Site-AccueilGetShow') }}">Retour</a>
                      <a class="btn btn-danger" href="{{ route('Site-CartGetClear') }}">Vider le panier</a>
                    </div>
                  </div>
                
              </div>

              <!-- Colonne pour afficher le sommaire -->
              <div class="col-lg-4 bg-body-tertiary">
                <div class="p-5">
                    <h4 class="fw-bold">Résumé de la commande</h4>
                    <hr class="my-4">
            
                    <!-- Total des plats commandés -->
                    <div class="d-flex justify-content-between mb-4">
                        <h5 class="text-uppercase">Plat(s) commandé(s):</h5>
                        <h5>{{ $cartCount }} plat(s)</h5>
                    </div>
            
                    <!-- Détails des plats -->
                    <h5 class="text-uppercase"><u>Totaux des Plats</u></h5><br>
                    @foreach ($cartItem as $cartItem)
                        <div class="d-flex justify-content-between mb-4 mr-4">
                            <h6 class="text-lowercase">{{ $cartItem['name'] }}:</h6>
                            <h6>{{ $cartItem['quantity'] }} x {{ $cartItem['price'] }} FCFA</h6>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h6 class="text-lowercase">Accompagnement:</h6>
                            <h6>{{ $cartItem['accompaniment_price'] }}</h6>
                        </div>    
                    @endforeach
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <h6 class="text-uppercase">Prix total des plats:</h6>
                        <h6 id="total">{{ $total }} FCFA</h6>
                    </div>
                    <hr><br>
                    <!-- Coût de la livraison -->
                    <h5 class="text-uppercase mb-3"><u>Coût de la livraison</u></h5>
                    <p>"Choisissez retrait sur place pour éviter les frais de livraison, ou sélectionnez une adresse pour une livraison sécurisée."</p>
                    <div class="mb-4 pb-2">
                        <select id="delivery" name="delivery" class="form-select mb-2" required>
                            <option value="" data-cost="0" disabled selected>Sélectionner un lieu de livraison</option>
                            <option value="1500" data-cost="1500">Livraison Yopougon - 1500 FCFA</option>
                            <option value="2000" data-cost="2000">Livraison Abobo - 2000 FCFA</option>
                            <option value="2500" data-cost="2500">Livraison Port-Bouet - 2500 FCFA</option>
                            <option value="1000" data-cost="1000">Livraison Cocody - 1000 FCFA</option>
                        </select>
                    </div>
            
                    <hr class="my-4">
            
                    <!-- Total final -->
                    <div class="d-flex justify-content-between mb-5">
                        <h5 class="text-uppercase">Total prix</h5>
                        <h5 id="final-total">{{ $total }} FCFA</h5> <!-- Total + frais de livraison -->
                    </div>
            
                    <!-- Bouton de commande -->
                    <a href="{{ route('Site-OrderGetShow') }}" data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Commander</a>
                </div>
              </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


