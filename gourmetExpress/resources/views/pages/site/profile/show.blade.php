@extends('layout.master')


@section('content')



<section style="background-color: #eee;">
    <div class="container py-5">
  
      <div class="row" style="margin-top:5rem;">
       
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center" style="width: 23rem; height:25rem;">
                
              <img src="{{ asset('asset/img/' . $user->gender . '.png') }}" alt="Avatar" class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3">
                {{ $user->name . $user->lastname}}
              </h5>
            </div>
          </div>
        </div>
        <div class="col-lg-8" style="width: 45rem;">
          <div class="card mb-4" style="height:25rem;">
            <div class="card-body">
                <br>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0 fw-bold">Nom & Prenom :</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">
                    {{ $user->name . $user->lastname }}
                  </p>
                </div>
              </div>
              <hr>
              <br><br>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0 fw-bold">Email:</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>
              </div>
              <hr>
               <br><br>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0 fw-bold">Genre:</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0">{{ $user->gender }}</p>
                </div>
              </div>
              <hr>
              <div class="d-flex justify-content-center mb-2">
                <a  href="{{route('Site-ProfilPostDestroy', $user->id)}}" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Suprimer</a>
                <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Message</button>
              </div>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </section>
  


@endsection