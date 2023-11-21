@extends('layout.appadmin')
@section('title')
ajouter categorie
@endsection
@section('contenu')

        <div class="row grid-margin">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Ajouter Categorie</h4>
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

                {!! Form::open(['action'=>'App\Http\Controllers\CategoryController@sauvercategorie' , 'method'=>'POST','class'=>'cmxform','id'=>'commentForm']) !!}
                     {{ csrf_field() }}
                <div class="form-group">
                    {!! Form::label('', 'Nom de la categorie', ['for'=>'cname']) !!}
                        {{-- <label for="cname">Name (required, at least 2 characters)</label> --}}
                    {!! Form::text('category_name', '', ['class'=>'form-control' , 'id'=>'cname']) !!}
                        {{-- <input id="cname" class="form-control" name="name" minlength="2" type="text" required> --}}
                      </div>
                      {{-- <div class="form-group">
                        <label for="cemail">E-Mail (required)</label>
                        <input id="cemail" class="form-control" type="email" name="email" required>
                      </div>
                      <div class="form-group">
                        <label for="curl">URL (optional)</label>
                        <input id="curl" class="form-control" type="url" name="url">
                      </div>
                      <div class="form-group">
                        <label for="ccomment">Your comment (required)</label>
                        <textarea id="ccomment" class="form-control" name="comment" required></textarea>
                      </div>
                      <input class="btn btn-primary" type="submit" value="Submit">
                    </fieldset> --}}
                  {{-- </form> --}}
                  {!! Form::submit('Ajouter', ['class'=>'btn btn-primary']) !!}
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
