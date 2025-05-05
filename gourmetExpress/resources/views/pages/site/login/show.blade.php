@extends('layout.main')


@section('content')





<section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
            class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form method="POST" action="{{route('postLogin')}}">
           @csrf

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
            <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">Connectez-Vous</button>
  
            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0 text-muted">
                <a href="{{route('Site-RegisterGetShow')}}">Vous n'avez pas de Compte? Inscrivez-Vous</a>
              </p>
            </div>
  
          </form>
        </div>
      </div>
    </div>
</section>






@endsection