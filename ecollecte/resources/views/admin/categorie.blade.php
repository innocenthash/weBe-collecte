@extends('layout.appadmin')
@section('title')
affiche categorie
@endsection


{{Form::hidden('' ,$increment=1)}}
@section('contenu')


@if ( Session::has('status'))
<div class="alert alert-success">
   <script > alert('{{Session::get('status')}}') </script>
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
              <h4 class="card-title">Categorie</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>

                            <th>Order</th>
                            <th>Nom de la categorie</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($categorie as $categories )
                          <tr>
                            <td>{{$increment}}</td>
                            <td>{{$categories->category_name}}</td>


                            <td>
                              <button class="btn btn-outline-primary" onclick="window.location='{{url('/edit_categorie/'.$categories->id)}}' ">Edit</button>
                            <a href="{{Url('/supprimer_category/'.$categories->id)}}" id="delete"class="btn btn-outline-danger">Delete</a>
                            </td>
                        </tr>

                        {{Form::hidden('' ,$increment=$increment+1)}}
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
