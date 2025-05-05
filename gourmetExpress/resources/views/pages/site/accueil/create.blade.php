@extends('layout.main')


@section('content')




<!-- Section: Design Block -->
<section class="text-center">
    <!-- Background image -->
    <div class="p-5 bg-image" style="background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg'); height: 300px;"></div>
    <!-- Background image -->
  
    <div class="card mx-4 mx-md-5 shadow-5-strong bg-body-tertiary" style="
          margin-top: -130px;
          backdrop-filter: blur(30px);
          ">
      <div class="card-body py-5 px-md-5">
  
        <div class="row d-flex justify-content-center">
          <div class="col-lg-8">
            <h2 class="fw-bold mb-5">Entrez Vos Plats</h2>
            <form method="POST" action="{{route('Site-AccueilPostStore')}}"  enctype="multipart/form-data">
               @csrf 
              <!-- 2 column grid layout with text inputs for the first and last names -->
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div data-mdb-input-init class="form-outline">
                    <input type="file" name="image" id="form3Example1" class="form-control" required/>
                    <label class="form-label" for="form3Example1">Image du Plat</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">
                  <div data-mdb-input-init class="form-outline">
                    <input type="text" name="name" id="form3Example2" class="form-control" required/>
                    <label class="form-label" for="form3Example2">Nom du Plat</label>
                  </div>
                </div>
              </div>
  
              <!-- Email input -->
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" name="price" id="form3Example3" class="form-control" required/>
                    <label class="form-label" for="form3Example3">Prix</label>
                  </div>
                </div>
                <div class="col-md-6 mb-4">  
                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" name="description" id="form3Example3" class="form-control" required/>
                    <label class="form-label" for="form3Example3">Description</label>
                  </div>
                </div>
              </div>    
  
              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="number" name="stock" id="form3Example4" class="form-control" required/>
                <label class="form-label" for="form3Example4">Stock</label>
              </div>
              <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" name="day" id="form3Example4" class="form-control" required/>
                <label class="form-label" for="form3Example4">Jours</label>
              </div>

              <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4">
                Enregistrer
              </button>
  
            </form>
          </div>
        </div>
      </div>
    </div>
    <br><br><br>
  </section>
  <!-- Section: Design Block -->



@endsection