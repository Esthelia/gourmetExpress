@extends('layout.master')


@section('content')



<main>

  <div class="" style="width:60rem; margin-left:8rem; margin-top:10rem;">
    <div class="card shadow" style="width:70rem;">
        <div class="card-header py-3">
            <h2 class="m-0 font-weight-bold text-secondary">Gestion des Commandes</h2>
        </div>
    </div>
    <br><br>
        <table class="table shadow align-middle bg-white border border-dark"
            style="width:55rem; heigh:40rem; margin-left:40px; margin-top:20px;">
            <thead class="bg-light">
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Total du Prix</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>
                            {{$order->description}}
                        </td>
                        <td>
                          {{$order->total}}  
                        </td>
                        <td>{{ $order->created_at }}</td>
                        <td>
                          <div class="dropdown" style="margin-right:100px;">
                            <span class="text-dark">Actions</span>
                            <div class="dropdown-content">
                            <p><a href="{{route('Site-AccueilGetEdit', $order->id)}}">Modifier</a></p>
                            <p><a href="{{route('Site-OrderPostDestroy', $order->id)}}">Suprimer</a></p>
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