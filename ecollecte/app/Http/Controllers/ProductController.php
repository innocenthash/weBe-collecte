<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category ;
use App\Models\Product ;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ajouterproduit(){
         $categorie = Category::All()->pluck('category_name','category_name') ;
        return view('admin.ajouterproduit')->with('categorie',$categorie);
    }
    public function sauverproduit(Request $request){
      $this->validate($request,['product_categorie'=>'required','product_name'=>'required' , 'product_price'=>'required' ,'product_image'=>'image|nullable|max:70000']) ;
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
          $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore) ;
      } else {
        $fileNameToStore = 'noimage.jpg' ;
      }

      $product = new Product() ;
      $product->product_name=$request->input('product_name') ;
      $product->product_price=$request->input('product_price') ;
      $product->product_category=$request->input('product_categorie') ;
      $product->product_image =  $fileNameToStore  ;
      $product->status=1 ;
      $product->save() ;

      return redirect('/ajouterproduit')->with('status','Le produit'.$product->product_name.'a été inserer avec succès ! ') ;

    }
    public function afficheproduit(){
        $produit = Product::get() ;

        return view('admin.produit')->with('produit' , $produit);
    }

    public function editproduit($id){
        $produit = Product::find($id) ;
        $categorie = Category::All()->pluck('category_name','category_name') ;
        return view('admin.editproduit')->with('produit',$produit)->with('categorie',$categorie);

    }
    public function modifierproduit(Request $request){

        $product = Product::find($request->input('id')) ;
        $product->product_name=$request->input('product_name') ;
        $product->product_price=$request->input('product_price') ;
        $product->product_category=$request->input('product_categorie') ;


        $this->validate($request,['product_categorie'=>'required','product_name'=>'required' , 'product_price'=>'required' ,'product_image'=>'image|nullable|max:70000']) ;
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
            $path = $request->file('product_image')->storeAs('public/product_images', $fileNameToStore) ;
            if(  $product->product_image!='noimage.jpg'){
                Storage::delete('public/product_images/'.$product->product_image) ;
            }
            $product->product_image= $fileNameToStore ;
        }


$product->update() ;
return redirect('/afficheproduit')->with('status','Le produit'.$product->product_name.'a été bien modifié avec succès !') ;
    }

    public function supprimerproduit($id){
        $produit = Product::find($id) ;
        if(  $produit->product_image!='noimage.jpg'){
            Storage::delete('public/product_images/'.$produit->product_image) ;
        }
$produit->delete() ;

return redirect('/afficheproduit')->with('status','Le produit'.$produit->product_name.'a été bien supprimer avec succès !') ;

    }
    public function activer_produit($id){
        $produit=Product::find($id) ;
        $produit->status=1 ;
        $produit->update() ;
        return redirect('/afficheproduit')->with('status','Le produit '.$produit->product_name.' a été activé avec succès !');

    }
    public function desactiver_produit($id){
        $produit=Product::find($id) ;
        $produit->status=0 ;
        $produit->update() ;
        return redirect('/afficheproduit')->with('status','Le produit'.$produit->product_name.'a été desactiver avec succès !');

    }
}
