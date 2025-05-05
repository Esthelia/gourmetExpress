@extends('layout.main')

@section('content')



<section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
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
        
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
            class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form method="POST" action="{{route('Site-RegisterPostStore')}}">
            @csrf

             <!-- Nom -->
             <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" name="name" id="form1Example13" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example13">Nom</label>
              </div>

              <!-- Prenom -->
             <div data-mdb-input-init class="form-outline mb-4">
                <input type="lastname" name="lastname" id="form1Example13" class="form-control form-control-lg" />
                <label class="form-label" for="form1Example13">Prenom</label>
              </div>


               <!-- genre -->
              <div class="col-md-6 mb-4">

                <h6 class="mb-2 pb-1">Genre: </h6>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" value="femme" checked />
                  <label class="form-check-label" >Feminin</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" value="homme" />
                  <label class="form-check-label">Masculin</label>
                </div>
              </div>


            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="email" name="email" id="form1Example13" class="form-control form-control-lg" />
              <label class="form-label" for="form1Example13">Adresse Email</label>
            </div>
  
            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <input type="password" name="password" id="form1Example23" class="form-control form-control-lg" />
              <label class="form-label" for="form1Example23">Mot de Passe</label>
            </div>
  
  
            <!-- Submit button -->
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">Valider</button>
  
            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0 text-muted">
                <a href="{{route('Site-LoginGetShow')}}">Vous avez deja un Compte? Connectez-Vous</a>
              </p>
            </div>
  
          </form>
        </div>
      </div>
    </div>
</section>



@endsection