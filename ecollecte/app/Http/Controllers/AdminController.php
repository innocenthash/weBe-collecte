<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande ;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard(){
        return view('admin.dashboard') ;
    }
    public function commande(){
        $commande = Commande::get() ;
        $commande->transform(function($commande,$key){
            $commande->panier = unserialize($commande->panier) ;
        }) ;
        return view('admin.commande')->with('commande',$commande) ;
        }



}
