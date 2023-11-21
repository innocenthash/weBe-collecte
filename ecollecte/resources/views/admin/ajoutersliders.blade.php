@extends('layout.appadmin')
@section('title')
ajouter slider
@endsection
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


        <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ajouter slider</h4>
                  {{-- <form class="cmxform" id="commentForm" method="get" action="#"> --}}
                {!! Form::open(['action'=>'App\Http\Controllers\SliderController@sauverslider' , 'method'=>'POST','class'=>'cmxform','id'=>'commentForm','enctype'=>'multipart/form-data']) !!}
                     {{ csrf_field() }}
                <div class="form-group">
                    {{Form::label('', 'Description1', ['for'=>'cname']) }}

                    {{Form::text('slider_description1', '', ['class'=>'form-control' , 'id'=>'cname']) }}

                 </div>
                 <div class="form-group">
                    {{Form::label('', 'Description2', ['for'=>'cname']) }}

                    {{Form::text('slider_description2', '', ['class'=>'form-control' , 'id'=>'cname']) }}

                 </div>


                 <div class="form-group">
                                {{ Form::label('', 'slider image', ['for'=>'cname']) }}

                                {{ Form::file('slider_image', ['class'=>'form-control' , 'id'=>'cname']) }}

                 </div>

                   {{Form::submit('Ajouter', ['class'=>'btn btn-primary']) }}
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>


@endsection
@section('scripts')
{{-- <script src="backend/js/form-validation.js"></script> --}}
  <script src="backend/js/bt-maxLength.js"></script>
@endsection
