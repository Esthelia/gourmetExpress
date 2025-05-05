@extends("layout.main")

@section('content')



<div class="card">

  <div class="card-body shadow" style="width: 45rem;">
    <div class="container mb-5">
      
      <div class="row d-flex align-items-baseline">
        <div class="col-xl-9">
          <p style="color: #7e8d9f; font-size: 20px;">Facture >> <strong>ID: {{ $order->id }}</strong></p>
        </div>
        <hr>
      </div>
     
      <div class="container">
        <div class="col-md-12">
          <div class="text-center">
            <i class="fab fa-mdb fa-4x ms-0" style="color:#0f0f0f;"></i>
            <p class="pt-0 fw-bold" style="font-size:30px;">Restaurant GourmetExpress</p>
          </div>
        </div>

        <br><br>
       
        <div class="row">
          <div class="col-xl-8">
            <ul class="list-unstyled">
              <li class="text-muted">Client: <span style="color:#041f2f;">{{ auth()->user()->name . ' ' . auth()->user()->lastname }}</span></li>
              <li class="text-muted">Email: <span style="color:#5d9fc5;">{{ auth()->user()->email }}</span></li>
              <li class="text-muted">Lieu de Livraison: <span style="color:#5d9fc5;">{{ $deliveryLocation ?? 'Retrait sur Place' }}</span></li>
            </ul>
          </div>
          <div class="col-xl-4">
            <ul class="list-unstyled">
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA;"></i> <span class="fw-bold">Numero facture:</span> {{ $order->id }}</li>
              <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA;"></i> <span class="fw-bold">Creation Date: </span> {{ $order->created_at }}</li>
            </ul>
          </div>
        </div>
       
        <div class="row my-2 mx-1 justify-content-center">
          <table class="table table-striped table-borderless">
            <thead style="background-color:#84B0CA;" class="text-white">
              <tr>
                <th scope="col">Description</th>
                <th scope="col">Quantité Commandé</th>
                <th scope="col">Prix Plat</th>
                <th scope="col">Accompagnement</th>
                <th scope="col">Total</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($order->orderItems as $item)
              <tr>
                <td>{{ $item->product->name }}</td>
                  <td>{{ $item->quantity }}</td>
                  <td>{{ ($item->price) }} FCFA</td>
                  <td>{{ ($item->accompaniment) }} FCFA</td> <!-- Affichage de l'accompagnement -->
                  <td>{{ (($item->quantity * $item->price) + ($item->accompaniment ?? 0)) }} FCFA</td> <!-- Total -->
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        
        <div class="row">
          <div class="col-xl-3">
            <ul class="list-unstyled">
              <li class="text-muted ms-3"><span class="text-black me-4">Cout Livraison:</span>{{ $deliveryCost ?? 'Gratuit' }} FCFA</li>
              <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Total</span>{{ $order->total }} FCFA</li>
            </ul>
          </div>
        </div>
        
        <hr>
        
        <div class="row">
          <div class="col-xl-10 ">
            <p> <strong>GourmetExpress</strong> vous dit Merci pour vos achats. A bientot pour une nouvelle commande</p>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>

</div>



<br>


@endsection