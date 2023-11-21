@extends('layout.appadmin')
@section('title')
affiche slider
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
              <h4 class="card-title">Sliders</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>

                            <th>Order</th>
                            <th>Image</th>
                            <th>Description1</th>
                            <th>Description2</th>

                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ( $slider as $sliders)
                          <tr>
                            <td>{{$increment}}</td>
                            <td><img src="/storage/slider_images/{{$sliders->slider_image}}" alt=""></td>

                            <td>{{$sliders->slider_description1}}</td>
                            <td>{{$sliders->slider_description2}}</td>
                            <td>
                                @if($sliders->status==1)
                                <label class="badge badge-success">Activé</label>
                                @else
                                <label class="badge badge-danger">Desactivé</label>
                                @endif
                               </td>
                             <td>
                               <button class="btn btn-outline-primary" onclick="window.location='{{url('/edit_slider/'.$sliders->id)}} '">Edit</button>
                             <a href="{{url('/supprimer_slider/'.$sliders->id)}}" class="btn btn-outline-danger" id='delete'>supprimer</a>
                             </td>
                             <td>
                                 @if($sliders->status==1)
                                 <button class="btn btn-outline-warning" onclick="window.location='{{url('/desactiver_slider/'.$sliders->id)}} '">Desactiver</button>
                                 @else
                                 <button class="btn btn-outline-success" onclick="window.location='{{url('/activer_slider/'.$sliders->id)}} '">Activer</button>
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

