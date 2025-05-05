@extends('layout.master')


@section('content')


<div style="margin-top:15rem;">
  <div class="container">
    @if (session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
  {{ session('error') }}
</div>
@endif
</div>


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
                          <h6 class="mb-0">{{ $cartItem['accompaniment'] }}</h6>
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
                    @foreach ($cartItems as $cartItem)
                        <div class="d-flex justify-content-between mb-4 mr-4">
                            <h6 class="text-lowercase">{{ $cartItem['name'] }}:</h6>
                            <h6>{{ $cartItem['quantity'] }} x {{ $cartItem['price'] }} FCFA</h6>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h6 class="text-lowercase">Accompagnement:</h6>
                            <h6>{{ $cartItem['accompaniment'] }}</h6>
                        </div>    
                    @endforeach
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-4">
                        <h6 class="text-uppercase">Prix total des plats:</h6>
                        <h6 id="total">{{ $total }} FCFA</h6>
                    </div>
                    <hr><br>
                    <!-- Coût de la livraison -->
                    {{-- <section>
                      <h5 class="text-uppercase mb-3"><u>Coût de la livraison</u></h5>
                      <p>"Choisissez retrait sur place pour éviter les frais de livraison, ou sélectionnez une adresse pour une livraison sécurisée."</p>
                      <div class="form-check mb-2">
                        <input class="form-check-input" type="case" name="delivery_option" id="pickup" value="pickup" data-cost="0" checked>
                        <label class="form-check-label" for="pickup">
                            Retrait sur place (Gratuit)
                        </label>
                      </div>
                      <div class="mb-4 pb-2">
                          <form id="delivery-form" method="POST" action="{{route('Site-DeliveryPostStore')}}">
                              @csrf
                              <select id="delivery" name="delivery" class="form-select mb-2" required>
                                  <option value="" data-cost="0" disabled selected>Sélectionner un lieu de livraison</option>
                                  <option value="1500" data-cost="1500" data-location="Yopougon">Livraison Yopougon - 1500 FCFA</option>
                                  <option value="2000" data-cost="2000" data-location="Abobo">Livraison Abobo - 2000 FCFA</option>
                                  <option value="2500" data-cost="2500" data-location="Port-Bouet">Livraison Port-Bouet - 2500 FCFA</option>
                                  <option value="1000" data-cost="1000" data-location="Cocody">Livraison Cocody - 1000 FCFA</option>
                              </select>
                              <input type="hidden" name="delivery_cost" id="delivery-cost-hidden">
                              <input type="hidden" name="delivery_location" id="delivery-location-hidden">

                              <hr class="my-4">

                              <div class="d-flex justify-content-between mb-5">
                                <h5 class="text-uppercase">Total prix</h5>
                                <h5 id="final-total">{{ $total }} FCFA</h5> 
                              </div>

                              <button type="submit" class="btn btn-dark btn-block btn-lg">Commander</button>
                          </form>
                  
                      
                       <br><br>
                      
                      <div id="delivery-details" class="mb-4" style="display: none;">
                          <h5 class="text-uppercase">Détails de la livraison</h5>
                          <p id="delivery-location"></p>
                          <p id="delivery-cost"></p>
                      </div>
                  
                     
                      
                  
                      
                    </section> --}}


                    <section>
                      <h5 class="text-uppercase mb-3"><u>Coût de la livraison</u></h5>
                      <p>"Choisissez retrait sur place pour éviter les frais de livraison, ou sélectionnez une adresse pour une livraison sécurisée."</p>
                      <div class="mb-4 pb-2">
                          <form id="delivery-form" method="POST" action="{{route('Site-DeliveryPostStore')}}">
                              @csrf
                  
                              <!-- Option de retrait sur place (case à cocher) -->
                              <div class="form-check mb-2">
                                  <input class="form-check-input" type="checkbox" name="delivery_option" id="pickup" value="pickup" data-cost="0">
                                  <label class="form-check-label" for="pickup">
                                      Retrait sur place (Gratuit)
                                  </label>
                              </div>
                  
                              <!-- Sélection de livraison -->
                              <select id="delivery-select" name="delivery" class="form-select mb-2">
                                  <option value="" data-cost="0" disabled selected>Sélectionner un lieu de livraison</option>
                                  <option value="1500" data-cost="1500" data-location="Yopougon">Livraison Yopougon - 1500 FCFA</option>
                                  <option value="2000" data-cost="2000" data-location="Abobo">Livraison Abobo - 2000 FCFA</option>
                                  <option value="2500" data-cost="2500" data-location="Port-Bouet">Livraison Port-Bouet - 2500 FCFA</option>
                                  <option value="1000" data-cost="1000" data-location="Cocody">Livraison Cocody - 1000 FCFA</option>
                              </select>
                              
                              <input type="hidden" name="delivery_cost" id="delivery-cost-hidden">
                              <input type="hidden" name="delivery_location" id="delivery-location-hidden">
                  
                              <hr class="my-4">
                  
                              <div class="d-flex justify-content-between mb-5">
                                  <h5 class="text-uppercase">Total prix</h5>
                                  <h5 id="final-total">{{ $total }} FCFA</h5> <!-- Total + frais de livraison -->
                              </div>
                  
                              <button type="submit" class="btn btn-dark btn-block btn-lg">Commander</button>
                          </form>
                  
                          <br><br>
                          <!-- Détails de la livraison -->
                          <div id="delivery-details" class="mb-4" style="display: none;">
                              <h5 class="text-uppercase">Détails de la livraison</h5>
                              <p id="delivery-location"></p>
                              <p id="delivery-cost"></p>
                          </div>
                      </div>
                    </section>
                  
                  
                  
                  
                    
                </div>
              </div>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>





{{-- <script>
  document.getElementById('delivery').addEventListener('change', function() {
      const selectedOption = this.selectedOptions[0];
      const deliveryCost = parseInt(selectedOption.getAttribute('data-cost'), 10);
      const deliveryLocation = selectedOption.getAttribute('data-location');

      // Mettre à jour les champs cachés
      document.getElementById('delivery-cost-hidden').value = deliveryCost;
      document.getElementById('delivery-location-hidden').value = deliveryLocation;

      // Mettre à jour les détails de la livraison affichés
      document.getElementById('delivery-location').textContent = 'Lieu de livraison: ' + deliveryLocation;
      document.getElementById('delivery-cost').textContent = 'Coût de la livraison: ' + deliveryCost + ' FCFA';
      document.getElementById('delivery-details').style.display = 'block';

      // Mettre à jour le total final
      const totalElement = document.getElementById('final-total');
      const currentTotal = parseInt(totalElement.textContent.replace(' FCFA', ''), 10);
      const finalTotal = currentTotal + deliveryCost;
      totalElement.textContent = finalTotal + ' FCFA';
  });
</script> --}}



<script>
  document.addEventListener('DOMContentLoaded', function() {
    const pickupCheckbox = document.getElementById('pickup');
    const deliverySelect = document.getElementById('delivery-select');
    const finalTotalElement = document.getElementById('final-total');
    const totalBasePrice = {{ $total }}; // Base price from backend

    function updateTotal() {
        let deliveryCost = 0;

        if (!pickupCheckbox.checked) {
            const selectedDelivery = deliverySelect.options[deliverySelect.selectedIndex];
            deliveryCost = parseInt(selectedDelivery.dataset.cost);
        }

        const finalTotal = totalBasePrice + deliveryCost;
        finalTotalElement.textContent = `${finalTotal} FCFA`;

        document.getElementById('delivery-cost-hidden').value = deliveryCost;
        document.getElementById('delivery-location-hidden').value = pickupCheckbox.checked ? '' : deliverySelect.options[deliverySelect.selectedIndex].dataset.location;
    }

    pickupCheckbox.addEventListener('change', function() {
        deliverySelect.disabled = pickupCheckbox.checked;
        updateTotal();
    });

    deliverySelect.addEventListener('change', updateTotal);

    // Initial update
    updateTotal();
});

</script>
















@endsection