@extends('layout.appadmin')
@section('title')
Liste de Commande
@endsection

{!! Form::hidden('', $increment=1) !!}

@section('contenu')

          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Commandes</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>

                            <th>Order</th>
                            <th>Nom du client</th>
                            <th>Adresse</th>
                            <th>Panier</th>
                            <th>Payement id</th>

                            <th>Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach ( $commande as $commandes)
                      <tr>
                        <td>{{$increment}}</td>
                        <td>{{$commandes->nom}}</td>

                        <td>{{$commandes->adresse}}</td>
                        <td>
                            @foreach ($commande->panier->items as $item)
                            {{$item['product_name']}}
                            @endforeach
                        </td>
                        <td>{{$commandes->payement_id}}</td>
                        <td>
                          <button class="btn btn-outline-primary">View</button>
                          <button class="btn btn-outline-primary">Delete</button>
                        </td>
                    </tr>
                    {!! Form::hidden('', $increment= $increment+1) !!}
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
