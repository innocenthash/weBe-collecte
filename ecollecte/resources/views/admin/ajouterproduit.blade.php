@extends('layout.appadmin')
@section('title')
ajouter produit
@endsection
@section('contenu')

        <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ajouter produit</h4>
                  {{-- <form class="cmxform" id="commentForm" method="get" action="#"> --}}
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
                {!! Form::open(['action'=>'App\Http\Controllers\ProductController@sauverproduit' , 'method'=>'POST','class'=>'cmxform','id'=>'commentForm','enctype'=>'multipart/form-data']) !!}
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

                            {{-- <select name="" id="">
                                <option value="">Select</option>
                                @foreach ($categorie as $categories )
                                <option value="">{{$categories->category_name}}</option>
                                @endforeach
                            </select> --}}

                               </div>
                              <div class="form-group">
                                {{ Form::label('', 'image', ['for'=>'cname']) }}

                                {{ Form::file('product_image', ['class'=>'form-control' , 'id'=>'cname']) }}

                                   </div>

                   {{Form::submit('Ajouter', ['class'=>'btn btn-primary']) }}
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>


@endsection
@section('scripts')
 {{-- <script src="backend/js/form-validation.js"></script>
  <script src="backend/js/bt-maxLength.js"></script> --}}
@endsection
