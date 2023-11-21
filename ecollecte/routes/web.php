<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// pour la page home : voalohany

Route::get('/','App\Http\Controllers\ClientController@home') ;
// pour acheter
Route::get('/shop','App\Http\Controllers\ClientController@shop') ;
// pour le panier cart
Route::get('/panier','App\Http\Controllers\ClientController@panier') ;

// pour le payement checkout
Route::get('/paiement','App\Http\Controllers\ClientController@paiement') ;
// login client
Route::get('/loginclient','App\Http\Controllers\ClientController@login_client') ;
//
Route::get('/signup','App\Http\Controllers\ClientController@signup') ;
//select par categorie
Route::get('/selectparcategorie/{name}','App\Http\Controllers\ClientController@selectparcategorie') ;
// ajouter au panier
Route::get('/ajouter_au_panier/{id}','App\Http\Controllers\ClientController@ajouteraupanier') ;
//modifier le panier
Route::post('/modifier_qty/{id}','App\Http\Controllers\ClientController@modifierqty');
// retirer du panier
Route::get('/retirerproduitdupanier/{id}','App\Http\Controllers\ClientController@retirerproduitdupanier');

//payement
Route::post('/payer','App\Http\Controllers\ClientController@payer');
//************************************* */
Route::get('/payment', 'App\Http\Controllers\PaymentController@index');
Route::get('/paiement', 'App\Http\Controllers\ClientController@paiement');
// ****************************************

// ******************************************connection **********************************//
Route::post('/creation_compte_client','App\Http\Controllers\ClientController@compte_client') ;
Route::post('/acceder_au_compte_client','App\Http\Controllers\ClientController@acceder_au_compte_client');
// ******************************************deconnection****************************
Route::get('/deconnection','App\Http\Controllers\ClientController@deconnecter') ;

///     aadmin route
Route::get('/admin','App\Http\Controllers\AdminController@dashboard') ;
Route::get('/commande','App\Http\Controllers\AdminController@commande') ;



// category route
Route::get('/ajoutercategorie','App\Http\Controllers\CategoryController@ajoutercategorie') ;
// sauvegarder categorie
Route::post('/sauvercategorie','App\Http\Controllers\CategoryController@sauvercategorie') ;
//affichage categorie
Route::get('/affichecategorie','App\Http\Controllers\CategoryController@affichecategorie');
//editer produits
Route::get('/edit_categorie/{id}','App\Http\Controllers\CategoryController@editcategorie') ;
// modifier categorie
Route::post('/modifiercategorie','App\Http\Controllers\CategoryController@modifiercategorie') ;
//supprimer categorie
Route::get('/supprimer_category/{id}','App\Http\Controllers\CategoryController@supprimercategorie') ;


//sauvegarder produit
Route::post('/sauverproduit','App\Http\Controllers\ProductController@sauverproduit') ;
// ajout produit
Route::get('/ajouterproduit','App\Http\Controllers\ProductController@ajouterproduit') ;
//affiche produit
Route::get('/afficheproduit','App\Http\Controllers\ProductController@afficheproduit');
//edit produit
Route::get('/edit_produit/{id}','App\Http\Controllers\ProductController@editproduit');
//modifier produit
Route::post('/modifierproduit','App\Http\Controllers\ProductController@modifierproduit');
//supprimer produit
Route::get('/supprimerproduit/{id}','App\Http\Controllers\ProductController@supprimerproduit');
//Activer Produits
Route::get('/activer_produit/{id}','App\Http\Controllers\ProductController@activer_produit') ;
// Desactiver produit
Route::get('/desactiver_produit/{id}','App\Http\Controllers\ProductController@desactiver_produit') ;




//ajouter slider
Route::get('/ajouterslider','App\Http\Controllers\SliderController@ajouterslider') ;
// sauver slider
Route::post('/sauverslider','App\Http\Controllers\SliderController@sauverslider') ;
//affichage slider
Route::get('/afficheslider','App\Http\Controllers\SliderController@afficheslider');
// editer slider
Route::get('/edit_slider/{id}','App\Http\Controllers\SliderController@editslider');
// modifier slider
Route::post('/modifierslider','App\Http\Controllers\SliderController@modifierslider');
//supprimer
Route::get('/supprimer_slider/{id}','App\Http\Controllers\SliderController@supprimerslider');
//Activer slider
Route::get('/activer_slider/{id}','App\Http\Controllers\SliderController@activer_slider') ;
// Desactiver slider
Route::get('/desactiver_slider/{id}','App\Http\Controllers\SliderController@desactiver_slider') ;







Auth::routes();

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);



//
// publication des utilisateurs

Route::get('/publication', 'App\Http\Controllers\ClientController@publication') ;
Route::post('/sauverpublication', 'App\Http\Controllers\ClientController@sauverpublicitation') ;
// cote admin
Route::get('/affichepublication', 'App\Http\Controllers\ClientController@affichepubclient') ;
//
Route::get('/activer_publication/{id}', 'App\Http\Controllers\ClientController@activer_publication');
Route::get('/desactiver_publication/{id}', 'App\Http\Controllers\ClientController@desactiver_publication');

Route::get('/edit_publication/{id}', 'App\Http\Controllers\ClientController@edit_publication') ;
Route::post('/modifier_publication', 'App\Http\Controllers\ClientController@modifier_publication') ;
Route::get('/supprimer_publication/{id}', 'App\Http\Controllers\ClientController@supprimer_publication') ;
