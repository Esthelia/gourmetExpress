@extends("layout.main")

@section('content')



<div class="card">

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
  
  <div>
    <a href="{{route('Site-AccueilGetShow')}}" class="btn btn-primary mt-3">Retour</a>
  </div>

  {{-- <div class="card-body shadow d-flex justify-content-center" style="width: 52rem; margin-left:18rem; height:50rem; margin-top:40px;">
    <div class="container mb-2 mt-3">
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

            <br><br><br><br>

            <div class="row">
                <div class="col-xl-8">
                    <ul class="list-unstyled">
                        <li class="text-muted">Client: <span style="color:#041f2f;">{{ auth()->user()->name . ' ' . auth()->user()->lastname }}</span></li>
                        <li class="text-muted">Email: <span style="color:#5d9fc5;">{{ auth()->user()->email }}</span></li>
                        <li class="text-muted">Lieu de Livraison: <span style="color:#5d9fc5;">{{ $deliveryLocation ?? 'non specifié' }}</span></li>
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
                            <td>{{ ($item->price) }}</td>
                            <td>{{ ($item->accompaniment) }}</td>
                            <td>{{ (($item->quantity * $item->price) + ($item->accompaniment ?? 0)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-xl-5">
                    <ul class="list-unstyled">
                        <li class="text-muted ms-3"><span class="text-black me-4">Coût de Livraison :</span>{{ $deliveryCost ?? 'non spécifié' }} FCFA</li>
                        <li class="text-muted ms-3"><span class="text-black me-4">Net à Payer :</span>{{ $finalTotal ?? 'non spécifié' }} FCFA</li>
                    </ul>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-xl-10">
                    <p> Cliquez sur le bouton à gauche pour télécharger votre facture.
                    <br>Merci pour vos achats. À bientôt pour une nouvelle commande</p>
                </div>
                <div class="col-xl-2">
                    <form method="POST" action="{{route('invoice.download', ['id' => $order->id])}}" class="btn btn-primary text-capitalize" style="background-color:#60bdf3;">
                        @csrf 
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-download"></i>
                        </button>
                    </form>   
                </div>
            </div>
        </div>
    </div>
  </div> --}}



  <div class="card-body shadow d-flex justify-content-center" style="width: 52rem; margin-left:18rem; height:50rem; margin-top:40px;">
    <div class="container mb-2 mt-3">
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

            <br><br><br><br>

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
                        <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA;"></i> <span class="fw-bold">Date de création: </span> {{ $order->created_at }}</li>
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
                            <td>{{ ($item->price) }}</td>
                            <td>{{ ($item->accompaniment) }}</td>
                            <td>{{ (($item->quantity * $item->price) + ($item->accompaniment ?? 0)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-xl-5">
                    <ul class="list-unstyled">
                        <li class="text-muted ms-3"><span class="text-black me-4">Coût de Livraison :</span>{{ $deliveryCost ?? 'Cratuit' }}</li>
                        <li class="text-muted ms-3"><span class="text-black me-4">Net à Payer :</span>{{ $finalTotal ?? 'finalTotal' }} FCFA</li>
                    </ul>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-xl-10">
                    <p> Cliquez sur le bouton à gauche pour télécharger votre facture.
                    <br>Merci pour vos achats. À bientôt pour une nouvelle commande</p>
                </div>
                <div class="col-xl-2">
                    <form method="POST" action="{{ route('invoice.download', ['id' => $order->id]) }}" class="btn btn-primary text-capitalize" style="background-color:#60bdf3;">
                        @csrf 
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-download"></i>
                        </button>
                    </form>   
                </div>
            </div>
        </div>
    </div>
  </div>




  


</div>



<br>


@endsection