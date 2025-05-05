<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="height:6rem;">
      <div class="container-fluid">
      
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{route('Site-AccueilGetShow')}}">Accueil</a>
            </li>

            
            <li class="nav-item">
             
            </li>
          </ul>
          <a href="{{route('Site-CartGetShow')}}" class="me-4 text-white" style="text-decoration: none;">
            <i class="bi fs-3 bi-cart-fill">({{ $cartCount }})</i> 
          </a>
         
          <!-- Example single danger button -->
          <div class="dropdown" style="margin-right:20px;">
            <span class="text-white btn btn-outline-secondary shadow)">
              <i class="bi bi-gear"></i>
              Paramètre
            </span>
            <div class="dropdown-content">
            <p><a href="{{route('Site-ParametreGetShow')}}" style="text-decoration: none; color:black;">Gestion Parametre</a></p>
            <hr>
            <p>
              <form action="{{ route('postLogout') }}" method="POST">
                @csrf
              <button type="submit" class="btn btn-primary">Deconnecter</button>
              </form>
            </p>
            </div>
          </div>

          <div class="btn btn-secondary text-white">
            <a href="{{route('Site-LoginGetShow')}}" style="text-decoration: none; color:white;"><i class="bi bi-person-circle"></i></a>
          </div>
          
        </div>
      </div>
    </nav>
</header>






