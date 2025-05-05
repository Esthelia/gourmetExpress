@extends('layout.master')

@section('content')



<div class="row" style="margin-top:10rem; margin-left:15rem; text-align:center;">
    <div class="card shadow me-4" style="margin-right:100rem; width:58rem;">
        <h1 class="text-danger fw bold" style="font-size:3rem; text-align:center">Gestion Des Parametres</h1>
    </div>
    <br><br>
    <div class="col-sm-5 mt-5">
      <div class="card shadow" style="height: 8rem; position: relative; overflow: hidden;">
        <div class="card-body" style="background-color:rgb(151, 11, 25);">
            <div class="card-body" style="position: relative; z-index: 2;">
                <a href="{{route('Site-ProfilGetShow')}}" style="text-decoration:none; color:rgb(251, 248, 248);">
                    <h5 class="card-title" style="font-size:30px; font-family: monospace;">Profil</h5>
                </a>
            </div>
            <i class="bi bi-gear-fill" style="position: absolute; left: 19rem; top: 50%; transform: translateY(-50%);font-size: 10rem; color: rgba(95, 5, 5, 0.927); z-index: 1;"></i>
        </div>
      </div>
    </div>
    <div class="col-sm-5 mt-5">
      <div class="card shadow" style="height: 8rem; position: relative; overflow: hidden;">
        <div class="card-body" style="background-color:rgb(47, 92, 13);">
            <div class="card-body" style="position: relative; z-index: 2;">
              <a href="{{route('Site-AccueilGetCreate')}}" style="text-decoration:none; color:rgb(244, 237, 237);">
                <h5 class="card-title" style="font-size:30px; font-family: monospace;">Ajouter Un Plat</h5>
              </a>
            </div>
            <i class="bi bi-gear-fill" style="position: absolute; left: 19rem; top: 50%; transform: translateY(-50%);font-size: 10rem; color: rgba(11, 42, 15, 0.927); z-index: 1;"></i>
        </div>
      </div>
    </div>
      <div class="col-sm-5 mt-4" style="height: 20rem;">
       <div class="card shadow" style="height: 8rem; position: relative; overflow: hidden;">
         <div class="card-body" style="background-color:rgb(26, 58, 157);">
            <a href="{{route('Site-AccueilGetIndex')}}" style="text-decoration:none; color:rgb(246, 241, 241);">
             <h5 class="card-title" style="font-size:30px; font-family: monospace;">Listes Des Plats</h5>
            </a>
          </div>
          <i class="bi bi-gear-fill" style="position: absolute; left: 19rem; top: 50%; transform: translateY(-50%);font-size: 10rem; color: rgba(19, 4, 87, 0.927); z-index: 1;"></i>
        </div>
      </div>
      <div class="col-sm-5 mt-4" style="height: 20rem;">
        <div class="card shadow" style="height: 8rem;">
          <div class="card-body mt-4">
            <a href="{{route('Site-OrderGetIndex')}}" style="text-decoration:none; color:black;">
             <h5 class="card-title" style="font-size:30px; font-family: monospace;">Gestion Des Commandes</h5>
            </a>
          </div>
        </div>
      </div>
  </div>




@endsection