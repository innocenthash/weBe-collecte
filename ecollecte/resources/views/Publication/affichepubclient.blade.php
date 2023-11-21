@extends('layout.appadmin')
@section('title')
affiche produits publié
@endsection


{{Form::hidden('',$increment=1)}}
@section('contenu')

@if ( Session::has('status'))
<div class="alert alert-success">
   {{Session::get('status')}}
</div>
@endif
@if (count($errors)>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">
<li>{{$error}}</li>
</div>

@endforeach
@endif
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Produit a executé</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>

                            <th>Ordre</th>
                            <th>Image</th>
                            <th>Nom du produit</th>
                            <th>Categorie du produit</th>
                            <th>Prix</th>
                            <th>Placement</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach ($produit as $produits)
                       <tr>
                        <td>{{$increment}}</td>
                        <td><img src="/storage/publication_images/{{$produits->product_image}}" alt=""></td>
                        <td>{{$produits->product_name}}</td>
                        <td>{{$produits->product_category}}</td>
                        <td>{{$produits->product_price}}</td>
                        <td>{{$produits->product_place}}</td>
                        <td>{{$produits->product_description}}</td>
                        <td>
                           @if($produits->status==1)
                           <label class="badge badge-success">Activé</label>
                           @else
                           <label class="badge badge-danger">Desactivé</label>
                           @endif
                          </td>
                        <td>
                          <button class="btn btn-outline-primary" onclick="window.location='{{url('/edit_publication/'.$produits->id)}} '">Edit</button>
                        <a href="{{url('/supprimer_publication/'.$produits->id)}}" class="btn btn-outline-danger" id='delete'>supprimer</a>
                        </td>
                        <td>
                            @if($produits->status==1)
                            <button class="btn btn-outline-warning" onclick="window.location='{{url('/desactiver_publication/'.$produits->id)}} '">Desactiver</button>
                            @else
                            <button class="btn btn-outline-success" onclick="window.location='{{url('/activer_publication/'.$produits->id)}} '">Activer</button>
                            @endif
                           </td>

                    </tr>
                    {{Form::hidden('',$increment=$increment+1)}}
                       @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>


@endsection

@section('script')
<script src="backend/js/data-table.js"></script>
@endsection

