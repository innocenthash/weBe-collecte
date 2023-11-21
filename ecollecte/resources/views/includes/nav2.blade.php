<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="ti-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
          <i class="ti-clipboard menu-icon"></i>
          <span class="menu-title">Creation</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="form-elements">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{URL::to('/ajoutercategorie')}}">Ajouter Categorie</a></li>
            <li class="nav-item"><a class="nav-link" href="{{URL::to('/ajouterproduit')}}">Ajouter Produit</a></li>
            <li class="nav-item"><a class="nav-link" href="{{URL::to('/ajouterslider')}}">Ajouter Sliders</a></li>

          </ul>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="ti-layout menu-icon"></i>
          <span class="menu-title">Affichage</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">

            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/affichecategorie')}}">Categories</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/afficheproduit')}}">Produits</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/afficheslider')}}">Sliders</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/commande')}}">Commandes</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/affichepublication')}}">Publication Clients</a></li>
          </ul>
        </div>
      </li>

      {{-- pour les membres  --}}

      {{-- <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
          <i class="ti-layout menu-icon"></i>
          <span class="menu-title">Membre</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="tables">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/')}}">Liste Membre</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/affichecategorie')}}">Categories</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/afficheproduit')}}">Produits</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/afficheslider')}}">Sliders</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{URL::to('/commande')}}">Commandes</a></li>
          </ul>
        </div>
      </li> --}}
    </ul>
  </nav>
