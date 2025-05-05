@extends('layout.master')



@section('content')





{{-- <main>
      
        
        
        <div>
          <div class="row d-flex" style="margin-top:8rem; margin-left:100px;">
            <div class="" style="width:19rem;">
              <div class="card" style="height:12rem;">
                <div class="card-body text-center">
                  <a href="#" class="" style="text-decoration: none;">
                    <img src="{{asset('asset/img/boeuf.png')}}" style="width:8rem;" alt="">
                  <h5 class="card-title ">VIANDE BOEUF</h5>
                  </a>
                </div>
              </div>
            </div>
            <div class="" style="width:19rem;">
              <div class="card" style="height:12rem;">
                <div class="card-body text-center">
                  <a href="#" class="" style="text-decoration: none;">
                    <img src="{{asset('asset/img/poisson.png')}}" style="width:8rem;" alt="">
                  <h5 class="card-title ">POISSON</h5>
                  </a>
                </div>
              </div>
            </div>
            <div class="" style="width:19rem;">
              <div class="card" style="height:12rem;">
                <div class="card-body text-center">
                  <a href="#" class="" style="text-decoration: none;">
                    <img src="{{asset('asset/img/porc.png')}}" style="width:8rem;" alt="">
                  <h5 class="card-title ">VIANDE PORC</h5>
                  </a>
                </div>
              </div>
            </div>
            <div class="" style="width:19rem;">
              <div class="card" style="height:12rem;">
                <div class="card-body text-center">
                  <a href="#" class="" style="text-decoration: none;">
                    <img src="{{asset('asset/img/poulet.jpeg')}}" style="width:8rem;" alt="">
                  <h5 class="card-title ">VIANDE DE POULET</h5>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
   
  
  
    
        
        <div class="card-body shadow p-3 mb-5 rounded" style="width:66rem; height:19rem; margin-top:80px; text-align:center; margin-left:158px; background-color:brown">
          <div class="card-text text-white">
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

            <br>
            <p style="font-size:20px;">{{$date}}</p>
            <p style="font-size:40px;">{{$jour}}</p>
             <h1 style="font-size:4rem;">Menu du Jour</h1>
             <p style="font-size:20px;">{{$menu}}</p>
          </div>
        </div>

  
        

    


    <div class="container mt-4" style="margin-left:9rem;">
      <h1>Produits pour {{ \Carbon\Carbon::now()->format('l') }}</h1>
      <div class="row">
          @foreach ($products as $index => $product)
              @if ($index % 3 === 0 && $index !== 0)
                  </div><div class="row mt-4">
              @endif
             
              <div class="col-md-4">
                  <div class="card shadow" style="width: 18rem;">
                      <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="width:18rem; height: 14rem;">
                      <div class="card-body">
                          <h5 class="card-title">{{ $product->name }}</h5>
                          <p class="text-danger fw-bold">{{ $product->price }} FCFA</p>
                          <p><span class="text-dark fw-bold">Stock Disponible:</span> {{ $product->stock }}</p>
                          <!-- Bouton pour ouvrir la modale -->
                          <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#monModal-{{ $product->id }}">
                              Détail
                          </button>
  
                          <!-- Contenu de la modale -->
                          <div class="modal fade" id="monModal-{{ $product->id }}" tabindex="-1" aria-labelledby="monModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="monModalLabel">Détails du produit</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                      </div>
                                      <div class="modal-body">
                                          <div class="card mb-3" style="max-width: 700px;">
                                              <div class="row g-0">
                                                  <div class="col-md-4">
                                                      <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-start" style="width:20rem; height:14rem;" alt="{{ $product->name }}">
                                                  </div>
                                                  <div class="col-md-8">
                                                      <div class="card-body">
                                                          <h5 class="card-title">{{ $product->name }}</h5>
                                                          <p>{{$product->description}}</p>
                                                          <p class="text-danger fw-bold"><small class="text-body-secondary">{{ $product->price }} FCFA</small></p>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <br>
                          <form method="POST" action="{{ route('Site-CartPostAdd', $product->id) }}">
                              @csrf
                              <input type="hidden" name="id" value="{{ $product->id }}">
                              <input type="hidden" name="name" value="{{ $product->name }}">
                              <input type="number" name="quantity" style="width: 50px;" value="1" min="1" class="form-control mb-2" required>
                              <select name="accompaniment" class="form-select mb-2" required>
                                  <option value="" disabled selected>Sélectionner un accompagnement</option>
                                  <option value="500">Attièké - 500 FCFA</option>
                                  <option value="1000">Riz Cartonnés - 1000 FCFA</option>
                                  <option value="500">Riz Normal à la vapeur - 500 FCFA</option>
                                  <option value="1000">Alloco - 1000 FCFA</option>
                                  <option value="1000">Frite - 1000 FCFA</option>
                              </select>
                              <input type="hidden" name="price" value="{{ $product->price }}">
                              <button type="submit" class="btn btn-primary ms-1">Ajouter au panier</button>
                          </form>
                      </div>
                  </div>
              </div>
          @endforeach
      </div>
    </div>  
</main>  --}}




  
  
<div class="container">
 


<!--CARROUSSEL -->
      
      <div id="carouselExampleIndicators" class="carousel slide mb-3 mt-5" data-ride="carousel">

        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="{{asset('asset/img/caroussel-1.jpg')}}" alt="First slide">
            
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{asset('asset/img/caroussel-2.jpg')}}" alt="Second slide">
            <div class="carousel-caption d-block caroussel-text">
            </div>
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="{{asset('asset/img/caroussel-3.jpg')}}" alt="Third slide">
            <div class="carousel-caption d-block caroussel-text">
            </div>
          </div>
        </div>
      </div>

      <!--PILLS -->

      <div class="carousel-caption d-block caroussel-text">
        <div class="card-text text-white">
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

          <br>
          <p style="font-size:20px;">{{$date}}</p>
          <p style="font-size:40px;">{{$jour}}</p>
           <h1 style="font-size:4rem;">Menu du Jour</h1>
           <p style="font-size:20px;">{{$menu}}</p>
        </div>
      </div>
      
        <div class="row d-flex" style="margin-top:-5rem; margin-left:60px;">
          <div class="" style="width:19rem;">
            <div class="card" style="height:12rem;">
              <div class="card-body text-center">
                <a href="#" class="" style="text-decoration: none;">
                  <img src="{{asset('asset/img/boeuf.png')}}" style="width:8rem;" alt="">
                <h5 class="card-title ">VIANDE BOEUF</h5>
                </a>
              </div>
            </div>
          </div>
          <div class="" style="width:19rem;">
            <div class="card" style="height:12rem;">
              <div class="card-body text-center">
                <a href="#" class="" style="text-decoration: none;">
                  <img src="{{asset('asset/img/poisson.png')}}" style="width:8rem;" alt="">
                <h5 class="card-title ">POISSON</h5>
                </a>
              </div>
            </div>
          </div>
          <div class="" style="width:19rem;">
            <div class="card" style="height:12rem;">
              <div class="card-body text-center">
                <a href="#" class="" style="text-decoration: none;">
                  <img src="{{asset('asset/img/porc.png')}}" style="width:8rem;" alt="">
                <h5 class="card-title ">VIANDE PORC</h5>
                </a>
              </div>
            </div>
          </div>
          <div class="" style="width:19rem;">
            <div class="card" style="height:12rem;">
              <div class="card-body text-center">
                <a href="#" class="" style="text-decoration: none;">
                  <img src="{{asset('asset/img/poulet.jpeg')}}" style="width:8rem;" alt="">
                <h5 class="card-title ">VIANDE DE POULET</h5>
                </a>
              </div>
            </div>
          </div>
        </div>
     
 
      

      <!-- CARDS HOBBITS -->

      {{-- <div class="row justify-content-center" style="margin-top:10rem;">
        <div class="col-10 col-md-6 col-lg-4 mb-3">
          <div class="card">
            <img class="card-img-top" src="http://images.innoveduc.fr/integration_gandalf.png" alt="Card image cap">
            <div class="card-body">
              <h3 class="card-title">The Wizard1</h3>
              <p class="card-text text-muted small">He is a powerfull wizard, able to make colored circular smoke</p>
              <div class="card-img-overlay text-light">
                <div class="reward">reward <span class="text_orange">1000</span> golden coins</div>
                <div class="fellowName text-center">Gandalf</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-10 col-md-6 col-lg-4 mb-3">
          <div class="card">
            <img class="card-img-top" src="https://zupimages.net/up/18/36/y2f4.jpg" alt="Card image cap">
            <div class="card-body">
              <h3 class="card-title">Hobbit #3</h3>
              <p class="card-text text-muted small">He is a powerfull wizard, able to make colored circular smoke</p>
              <div class="card-img-overlay text-light">
                <div class="dead">Dead</div>
                <div class="fellowName text-center">Pippin</div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-10 col-md-6 col-lg-4 mb-3">
          <div class="card">
            <img class="card-img-top" src="https://zupimages.net/up/18/36/3dg4.jpg" alt="Card image cap">
            <div class="card-body">
              <h3 class="card-title">Yummy dwarf</h3>
              <p class="card-text text-muted small">He is a powerfull wizard, able to make colored circular smoke</p>
              <div class="card-img-overlay text-light">
                <div class="reward">reward <span class="text_orange">1000</span> golden coins</div>
                <div class="fellowName text-center">Gimli</div>
              </div>
            </div>
          </div>
        </div>
      </div> --}}
      

      
        {{-- <h1>Produits pour {{ \Carbon\Carbon::now()->format('l') }}</h1> --}}
        <div class="row mt-4" style="">
            @foreach ($products as $index => $product)
                @if ($index % 3 === 0 && $index !== 0)
                    </div><div class="row mt-4">
                @endif
               
                <div class="col-md-4">
                    <div class="card shadow" style="width: 18rem; margin-left:5rem;">
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="width:18rem; height: 14rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="text-danger fw-bold">{{ $product->price }} FCFA</p>
                            <p><span class="text-dark fw-bold">Stock Disponible:</span> {{ $product->stock }}</p>
                            <!-- Bouton pour ouvrir la modale -->
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#monModal-{{ $product->id }}">
                                Détail
                            </button>
    
                            <!-- Contenu de la modale -->
                            <div class="modal fade" id="monModal-{{ $product->id }}" tabindex="-1" aria-labelledby="monModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="monModalLabel">Détails du produit</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card mb-3" style="max-width: 700px;">
                                                <div class="row g-0">
                                                    <div class="col-md-4">
                                                        <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded-start" style="width:20rem; height:14rem;" alt="{{ $product->name }}">
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $product->name }}</h5>
                                                            <p>{{$product->description}}</p>
                                                            <p class="text-danger fw-bold"><small class="text-body-secondary">{{ $product->price }} FCFA</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <form method="POST" action="{{ route('Site-CartPostAdd', $product->id) }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <input type="hidden" name="name" value="{{ $product->name }}">
                                <input type="number" name="quantity" style="width: 50px;" value="1" min="1" class="form-control mb-2" required>
                                <select name="accompaniment" class="form-select mb-2" required>
                                    <option value="" disabled selected>Sélectionner un accompagnement</option>
                                    <option value="500">Attièké - 500 FCFA</option>
                                    <option value="1000">Riz Cartonnés - 1000 FCFA</option>
                                    <option value="500">Riz Normal à la vapeur - 500 FCFA</option>
                                    <option value="1000">Alloco - 1000 FCFA</option>
                                    <option value="1000">Frite - 1000 FCFA</option>
                                </select>
                                <input type="hidden" name="price" value="{{ $product->price }}">
                                <button type="submit" class="btn btn-primary ms-1">Ajouter au panier</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
      
      
      
    
    </div>       
    

    
  </body>
</html>





@endsection