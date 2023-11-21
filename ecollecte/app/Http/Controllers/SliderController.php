<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\slider ;
use Illuminate\Support\Facades\Storage;



class SliderController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function ajouterslider(){
        return view('admin.ajoutersliders') ;
    }
    public function sauverslider(Request $request){
        $this->validate($request,['slider_description1'=>'required','slider_description2'=>'required' , 'slider_image'=>'image|nullable|max:70000']) ;
        if($request->hasFile('slider_image')){
            //maka fichier avec extension
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName() ;
            // maka lay anarana fotsiny
            $fileName = pathinfo( $fileNameWithExt,PATHINFO_FILENAME) ;
            //maka extension
            $extension= $request->file('slider_image')->getClientOriginalExtension() ;
            // anaranilay image ho enregistrer
            $fileNameToStore = $fileName.'_'.time().'.'.$extension ;
  // uploader l'image toerana asina azy
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore) ;
        } else {
          $fileNameToStore = 'noimage.jpg' ;
        }

    $slider = new slider() ;

    $slider->slider_description1=$request->input('slider_description1') ;

    $slider->slider_description2=$request->input('slider_description2') ;


    $slider->slider_image =  $fileNameToStore  ;

    $slider->status=1 ;

    $slider->save() ;

        return redirect('/ajouterslider')->with('status','Le slider a été inserer avec succès ! ') ;

    }
    public function afficheslider(){

        $slider = slider::get() ;

        return view('admin.slider')->with('slider' , $slider);
    }
    public function editslider($id){
        $slider = slider::find($id) ;

        return view('admin.editslider')->with('slider',$slider);
    }

    public function modifierslider(Request $request){

        $slider = slider::find($request->input('id')) ;
        $slider->slider_description1=$request->input('slider_description1') ;
        $slider->slider_description2=$request->input('slider_description2') ;



        $this->validate($request,['slider_description1'=>'required','slider_description2'=>'required' ,'slider_image'=>'image|nullable|max:70000']) ;
        if($request->hasFile('slider_image')){
            //maka fichier avec extension
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName() ;
            // maka lay anarana fotsiny
            $fileName = pathinfo( $fileNameWithExt,PATHINFO_FILENAME) ;
            //maka extension
            $extension= $request->file('slider_image')->getClientOriginalExtension() ;
            // anaranilay image ho enregistrer
            $fileNameToStore = $fileName.'_'.time().'.'.$extension ;
  // uploader l'image toerana asina azy
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore) ;
            if(  $slider->product_image!='noimage.jpg'){
                Storage::delete('public/slider_images/'.$slider->product_image) ;
            }
            $slider->slider_image= $fileNameToStore ;
        }


        $slider->update() ;
return redirect('/afficheslider')->with('status','Le slider a été bien modifié avec succès !') ;
    }
    public function supprimerslider($id){
        $slider = slider::find($id) ;
        if(  $slider->slider_image!='noimage.jpg'){
            Storage::delete('public/slider_images/'.$slider->slider_image) ;
        }
$slider->delete() ;

return redirect('/afficheslider')->with('status','Le Slider a été bien supprimer avec succès !') ;

    }

    public function activer_slider($id){
        $slider=slider::find($id) ;
        $slider->status=1 ;
        $slider->update() ;
        return redirect('/afficheslider')->with('status','Le slider a été activé avec succès !');

    }
    public function desactiver_slider($id){
        $slider=slider::find($id) ;
        $slider->status=0 ;
        $slider->update() ;
        return redirect('/afficheslider')->with('status','Le slider a été desactivé avec succès !');


    }
}
