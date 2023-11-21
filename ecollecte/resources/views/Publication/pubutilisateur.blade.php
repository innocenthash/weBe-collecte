
 @extends('layout.app1')
 @section('contenu')
<div class="row grid-margin">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Produit a mettre sur le marché</h4>
            @if ( Session::has('status'))
            <div class="alert alert-success">
            {{Session::get('status')}}
            {{Session::put('status',null)}}
            </div>
        @endif
        @if (count($errors)>0)
@foreach($errors->all() as $error)
<div class="alert alert-danger">
<li>{{$error}}</li>
</div>

@endforeach
        @endif
        {!! Form::open(['action'=>'App\Http\Controllers\ClientController@sauverpublicitation' , 'method'=>'POST','class'=>'cmxform','id'=>'commentForm','enctype'=>'multipart/form-data']) !!}
             {{ csrf_field() }}
        <div class="form-group">

            {{Form::label('', 'Nom du produit', ['for'=>'cname']) }}

            {{Form::text('product_name', '', ['class'=>'form-control' , 'id'=>'cname']) }}

              </div>
              <div class="form-group">
                {{Form::label('', 'prix du produit', ['for'=>'cname']) }}

                {{Form::text('product_price', '', ['class'=>'form-control' , 'id'=>'cname'])}}

                  </div>
                   <div class="form-group">
                    {{ Form::label('', 'categorie du produit') }}

                    {!! Form::select('product_categorie', $categorie,null,['placeholder'=>'select categorie','class'=>'form-control' , 'id'=>'cname']) !!}


                       </div>

                       <div class="form-group">
                        {{Form::label('', 'Placement du produit', ['for'=>'cname']) }}

                        {{Form::text('product_place', '', ['class'=>'form-control' , 'id'=>'cname'])}}

                          </div>

                          <div class="form-group">
                            {{Form::label('', 'description du produit', ['for'=>'cname']) }}

                            {{Form::text('product_description', '', ['class'=>'form-control' , 'id'=>'cname'])}}

                              </div>
                      <div class="form-group">
                        {{ Form::label('', 'image', ['for'=>'cname']) }}

                        {{ Form::file('product_image', ['class'=>'form-control' , 'id'=>'cname']) }}

                           </div>

           <div class="container-fluid">
                 <div class="row">

                        <div class="col-md-10"style="padding-left:0px;padding-top:5px;margin:0px">
                            {{Form::submit('Met vos produits', ['class'=>'btn btn-primary']) }}

                        </div>

                        <div class="col-md-2"style="padding-left:0px ;padding-top:5px;margin:0px" >
                            {{Form::reset('Annuler', ['class'=>'btn btn-danger']) }}
                        </div>

                 </div>
           </div>

          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
  @endsection
