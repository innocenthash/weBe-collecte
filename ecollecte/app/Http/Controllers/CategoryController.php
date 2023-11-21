<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category ;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ajoutercategorie(){
        return view('admin.ajoutercategorie') ;
    }
    public function sauvercategorie(Request $request){
// on cree un instance
$this->validate($request,['category_name'=>'required']) ;
$categorie = new Category() ;
$categorie->category_name = $request->input('category_name') ;


if($categorie->save()){
    return redirect('/ajoutercategorie')->with('status','La categorie '.$categorie->category_name.' a été ajouté avec succès') ;
}
    }
    public function affichecategorie(){
        $categorie = Category::get() ;
        return view('admin.categorie')->with('categorie',$categorie) ;
    }

    public function editcategorie($id){
$categorie = Category::find($id) ;
return view('admin.editcategorie')->with('categorie',$categorie) ;
    }

    public function modifiercategorie(Request $request){
$this->validate($request ,['category_name'=>'required']) ;
$categorie = Category::find($request->input('id')) ;
$categorie->category_name = $request->input('category_name') ;
$categorie->update() ;
return redirect('/affichecategorie')->with('status' , 'La categorie '.$categorie->category_name.' a été modifié avec succes !') ;

    }

    public function supprimercategorie($id){
       $categorie = Category::find($id) ;
       $categorie->delete() ;
       return redirect('/affichecategorie')->with('status','La categorie '.$categorie->category_name.' a été supprimer avec succes !') ;
    }
}


