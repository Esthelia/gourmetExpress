@extends('layout.master')


@section('content')



<div style="margin-top:5rem;">
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




<div class="card shadow" style="margin-top:8rem; width:50rem; margin-left:18rem; text-align:center">
  <h5 class="card-header">Bon de Commande</h5>
  <div class="card-body">
      <h5 class="card-title">Détail de la commande</h5>
      <p class="card-text">
          Il y a {{ $cartCount }} Article(s) dans votre panier.<br>
          Total des plats : <strong>{{ $total }} FCFA</strong><br>

          <!-- Affichage des détails de la livraison -->
          @if(session()->has('delivery_location') && session('delivery_location') === 'Retrait sur place')
              Lieu de livraison : <strong>Retrait sur place</strong><br>
              Coût de la livraison : <strong>Gratuit</strong><br>
          @else
              Lieu de livraison : <strong>{{ session('delivery_location') }}</strong><br>
              Coût de la livraison : <strong>{{ session('delivery_cost') }} FCFA</strong><br>
          @endif

          <em>Montant total à régler au livreur : <strong>{{ $total + session('delivery_cost', 0) }} FCFA</strong></em>
      </p>
      <form method="POST" action="{{ route('Site-OrderPostStore') }}">
          @csrf
          <button type="submit" class="btn btn-primary" data-mdb-ripple-init>
              Valider La Commande
          </button>
      </form>
  </div>
</div>







<br><br><br><br><br><br><br>


@endsection