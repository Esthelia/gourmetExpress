@extends('layout.master')


@section('content')



<main>

  <div class="" style="width:60rem; margin-left:15rem; margin-top:10rem;">
    <div class="card shadow">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-secondary">Gestion des Plats</h2>
        </div>
    </div>
    <br><br>
        <table class="table shadow align-middle bg-white border border-dark"
            style="width:55rem; heigh:40rem; margin-left:40px; margin-top:20px;">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Image du Plat</th>
                    <th>Nom du Plat</th>
                    <th>Prix</th>
                    <th>Stock Disponible</th>
                    <th>Jours</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>
                            <img src="{{ asset('storage/' . $product->image) }}" style="width: 60px;height: 60px;">
                        </td>
                        <td>
                            {{$product->name}}
                        </td>
                        <td>
                          {{$product->price}}  
                        </td>
                        <p></p>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->day }}</td>
                        <td>
                          <div class="dropdown" style="margin-right:100px;">
                            <span class="text-dark btn btn-outline-secondary">Actions</span>
                            <div class="dropdown-content">
                            <p><a href="{{route('Site-AccueilGetEdit', $product->id)}}">Modifier</a></p>
                            <p><a href="{{route('Site-AccueilPostDestroy', $product->id)}}">Suprimer</a></p>
                            </div>
                          </div>
                            {{-- <div class="btn-group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                  Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                  <li><a class="dropdown-item" href="">Modifier</a></li>                                  
                                  <li><a class="dropdown-item" href="">Supprimer</a></li>

                                </ul>
                            </div> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
  </div>    

  
</main> 





@endsection