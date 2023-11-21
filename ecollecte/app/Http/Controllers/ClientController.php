<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\slider ;
use App\Models\publicitation ;
use App\Models\Client ;
use App\Models\Product ;
use App\Models\Commande ;
use App\Models\Category ;
use Illuminate\Support\Facades\Session ;
use Illuminate\Support\Facades\Hash ;
use Omnipay\Omnipay ;
 use Stripe\Charge;

//use Illuminate\Omnipay\Omnipay;

//use Omnipay\Omnipay;
use App\Models\Payement;

use App\Cart ;

use Stripe\Stripe ;


class ClientController extends Controller
{
    //


    public function home(){


        $slider = slider::where('status',1)->get() ;
        $produit = Product::where('status',1)->get();

        return view('client.home')->with('slider',$slider)->with('produit',$produit) ;
    }


    public function shop(){
        // securité
        if(!Session::has('client')){
            return redirect('/loginclient') ;
        }
        $categorie = Category::get() ;
        $produit = publicitation::where('status',1)->get();

        return view('client.shop')->with('categorie',$categorie)->with('produit',$produit) ;
    }



    public function selectparcategorie($name){
        if(!Session::has('client')){
            return redirect('/loginclient') ;
        }
        $produit = publicitation::where('product_category',$name)->where('status',1)->get() ;
        $categorie = Category::get() ;
        return view('client.shop')->with('produit',$produit)->with('categorie',$categorie) ;
    }


// panier 1



    public function ajouteraupanier($id){

        if(!Session::has('client')){
            return redirect('/loginclient') ;
        }
        $product = Product::find($id) ;
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        Session::put('cart', $cart);

        // dd(Session::get('cart'));
         return redirect('/shop');
    }




    public function panier(){
        if(!Session::has('client')){
            return redirect('/loginclient') ;
        }
        if(!Session::has('cart')){
            return view('client.cart');
        }
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        return view('client.cart', ['products' => $cart->items]);
    }




    public function modifierqty(Request $request,$id){
        if(!Session::has('client')){
            return redirect('/loginclient') ;
        }
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->updateQty($id,$request->quantity) ;
        Session::put('cart', $cart);
        return redirect('/panier');

    }




    public function retirerproduitdupanier($id){
        if(!Session::has('client')){
            return redirect('/loginclient') ;
        }
        $oldCart = Session::has('cart')? Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id) ;
        if(count($cart->items)>0){
           Session::put('cart',$cart) ;
        }else{
            Session::forget('cart') ;
        }
        return redirect('/panier');
    }




// fermrture

// payment

public function payer(Request $request){

   Stripe::setApiKey('sk_test_51KwUm5AWxmh7GWY1Izwq6xV4zvUGfJmlSwzSkYbeYwnKxh19usiUOJFvuYozx5lsnJjb5yIG8t8VAns2SklaQbPc0074cZlMtr');
    if(!Session::has('cart')){
        return view('client.cart');
    }
    $oldCart = Session::has('cart')? Session::get('cart'):null;
    $cart = new Cart($oldCart);

    try{

        $charge = Charge::create(array(
            "amount" => $cart->totalPrice * 100,
            "currency" => "usd",
            "source" => $request->input('stripeToken'), // obtainded with Stripe.js
            "description" => "Test Charge"
        ));

// commandes

$commande = new Commande() ;
$commande->nom = $request->input('nom') ;
$commande->adresse = $request->input('adresse') ;
$commande->panier= serialize($cart) ;
$commande->payement_id = $charge->id ;
$commande->save() ;



    } catch(\Exception $e){
        Session::put('error', $e->getMessage());
        return redirect('/paiement');
    }

    Session::forget('cart');
    Session::put('success', 'Purchase accomplished successfully !');
    return redirect('/panier')->with('status','Votre payement est reussi ! ');




}



/// payement autre methode
// public function charge(Request $request)
// {


// if ($request->input('stripeToken')){
// //$gateway=Omnipaycreate('Stripe');

// $gateway = Omnipay::create('Stripe') ;
// $gateway->setApiKey(env('STRIPE_SECRET_KEY'));
// $token = $request->input('stripeToken');
// $response = $gateway->purchase(['amount' => $request->input('amount'),'currency' => env('STRIPE_CURRENCY'),'token' => $token,])->send();
// if ($response->isSuccessful()) {
// // payment was successful: insert transaction data into the database
// $arr_payment_data = $response->getData();
// $isPaymentExist = Payement::where('payment_id', $arr_payment_data['id'])->first();

// if(!$isPaymentExist){
// $payment = new Payement;
// $payment->payment_id = $arr_payment_data['id'];
// $payment->payer_email = $request->input('email');
// $payment->amount = $arr_payment_data['amount']/100;
// $payment->currency = env('STRIPE_CURRENCY');
// $payment->payment_status = $arr_payment_data['status'];
// $payment->save();
// }
// return "Payment is successful. Your payment id is: ". $arr_payment_data['id'];
// }else{
//     // payment failed: display message to customer
// return $response->getMessage();
// }
// }
// }


///////////
    public function paiement(){
        // rehef deconnecter izy de connectena

        return view('client.checkout') ;
    }
    public function login_client(){
        return view('client.login') ;
    }
    public function signup(){
        return view('client.signup') ;
    }


    // systeme d'authentification
    public function compte_client(Request $request){
        $this->validate($request,['email'=>'required|unique:clients','pass'=>'required|min:6']) ;
        $client = new Client() ;
        $client->email = $request->input('email') ;
        $client->password = bcrypt($request->input('pass')) ;
         $client->save() ;
         return back()->with('status' ,'votre compte a été creé avec succeès') ;
    }


    public function acceder_au_compte_client(Request $request){
        $this->validate($request,['email'=>'required','pass'=>'required']) ;
        $client = Client::where('email',$request->input('email'))->first() ;
 if($client){
           if(Hash::check($request->input('pass'),$client->password)){
               Session::put('client',$client) ;
                    return redirect('/shop') ;
           }else{
    return back()->with('status' , "Votre Mot de pass est incorrect") ;
           }
 }else{
    return back()->with('status','Veillez verifier votre e-mail') ;
 }


    }




    public function deconnecter(){
        if(!Session::has('client')){
            return redirect('/loginclient') ;
        }
        Session :: forget('client') ;
        Session::forget('cart') ;
        if(!Session::has('client')){
            return redirect('/loginclient') ;
        }
    }


    // ajout pub pour chaque utlisateur

    public function publication(){
        if(!Session::has('client')){
            return redirect('/loginclient') ;
        }
        $categorie = Category::All()->pluck('category_name','category_name') ;
        return view('Publication.pubutilisateur')->with('categorie',$categorie) ;
    }

    public function sauverpublicitation(Request $request){
        if(!Session::has('client')){
            return redirect('/loginclient') ;
        }
        $this->validate($request,['product_categorie'=>'required','product_description'=>'required','product_place'=>'required','product_name'=>'required' , 'product_price'=>'required' ,'product_image'=>'image|nullable|max:70000']) ;
        if($request->hasFile('product_image')){
            //maka fichier avec extension
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName() ;
            // maka lay anarana fotsiny
            $fileName = pathinfo( $fileNameWithExt,PATHINFO_FILENAME) ;
            //maka extension
            $extension= $request->file('product_image')->getClientOriginalExtension() ;
            // anaranilay image ho enregistrer
            $fileNameToStore = $fileName.'_'.time().'.'.$extension ;
  // uploader l'image toerana asina azy
            $path = $request->file('product_image')->storeAs('public/publication_images', $fileNameToStore) ;
        } else {
          $fileNameToStore = 'noimage.jpg' ;
        }

        $product = new publicitation() ;
        $product->product_name=$request->input('product_name') ;
        $product->product_price=$request->input('product_price') ;
        $product->product_category=$request->input('product_categorie') ;
        $product->product_place=$request->input('product_place') ;
        $product->product_description=$request->input('product_description') ;
        $product->product_image =  $fileNameToStore  ;
        $product->status=0 ;
        $product->save() ;

        return redirect('/publication')->with('status','Le produit '.$product->product_name.' a été inserer avec succès ! ') ;

      }

      public function affichepubclient(){
        if(!Session::has('client')){
            return redirect('/loginclient') ;
        }
        $produit = publicitation::get() ;

        return view('Publication.affichepubclient')->with('produit' , $produit);
      }

      public function activer_publication($id){
        $produit=publicitation::find($id) ;
        $produit->status=1 ;
        $produit->update() ;
        return redirect('/affichepublication')->with('status','Le produit '.$produit->product_name.' a été activé avec succès !');

    }
    public function desactiver_publication($id){
        $produit=publicitation::find($id) ;
        $produit->status=0 ;
        $produit->update() ;
        return redirect('/affichepublication')->with('status','Le produit'.$produit->product_name.'a été desactiver avec succès !');

    }

    public function edit_publication($id){
        $produit = publicitation::find($id) ;
        $categorie = Category::All()->pluck('category_name','category_name') ;
        return view('Publication.editpubclient')->with('produit',$produit)->with('categorie',$categorie);

    }
    public function modifier_publication(Request $request){

        $product = publicitation::find($request->input('id')) ;
        $product->product_name=$request->input('product_name') ;
        $product->product_price=$request->input('product_price') ;
        $product->product_place=$request->input('product_place') ;
        $product->product_description=$request->input('product_description') ;
        $product->product_category=$request->input('product_categorie') ;


        $this->validate($request,['product_categorie'=>'required','product_name'=>'required' , 'product_price'=>'required' ,'product_place'=>'required' ,'product_description'=>'required' ,'product_image'=>'image|nullable|max:70000']) ;
        if($request->hasFile('product_image')){
            //maka fichier avec extension
            $fileNameWithExt = $request->file('product_image')->getClientOriginalName() ;
            // maka lay anarana fotsiny
            $fileName = pathinfo( $fileNameWithExt,PATHINFO_FILENAME) ;
            //maka extension
            $extension= $request->file('product_image')->getClientOriginalExtension() ;
            // anaranilay image ho enregistrer
            $fileNameToStore = $fileName.'_'.time().'.'.$extension ;
  // uploader l'image toerana asina azy
            $path = $request->file('product_image')->storeAs('public/publication_images', $fileNameToStore) ;
            if(  $product->product_image!='noimage.jpg'){
                Storage::delete('public/publication_images/'.$product->product_image) ;
            }
            $product->product_image= $fileNameToStore ;
        }


$product->update() ;
return redirect('/affichepublication')->with('status','Le produit'.$product->product_name.'a été bien modifié avec succès !') ;
    }

    public function supprimer_publication($id){
        $produit = publicitation::find($id) ;
        if(  $produit->product_image!='noimage.jpg'){
            Storage::delete('public/publication_images/'.$produit->product_image) ;
        }
$produit->delete() ;

return redirect('/affichepublication')->with('status','Le produit'.$produit->product_name.'a été bien supprimer avec succès !') ;

    }
}
