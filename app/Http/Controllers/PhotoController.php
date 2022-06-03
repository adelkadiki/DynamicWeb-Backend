<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Image;


class PhotoController extends Controller
{
    
    // Logo function
    public function photoUpload(Request $req){

        //dd($req->all());        

        if($req->hasFile('photo')){

            // deleting the old photo

            $photo = DB::table('photos')->where('name', 'logo.jpg')->first();
            
            if(Storage::exists('public/photos/logo.jpg') && $photo){

                 DB::table('photos')->where('name', 'logo.jpg')->delete();
                 Storage::delete('public/photos/logo.jpg');
               
            }
            
            
              
                 // saving then new photo
                
            $fileName = 'logo.jpg';

           $path = $req->file('photo')->storeAs('public/photos', $fileName);
          
           $img = Image::make(storage_path('app/public/photos/logo.jpg'))->resize(null, 100, function($constraint){
            $constraint->aspectRatio();
           })->save(storage_path('app/public/photos/logo.jpg'));  
           
   
            $newPhoto = new Photo;
            $newPhoto->name = $fileName;
            $newPhoto->path = $path;
            $newPhoto->save();
            return response('image saved' , 201);

        }
        else {

            return response('Image not found', 404);
         }
    }


    // Background image function
    public function backGroundImage(Request $req){

        if($req->hasFile('bg')) {

            $photo = DB::table('photos')->where('name', 'bg.jpg')->first();
            
            if(Storage::exists('public/photos/bg.jpg') && $photo){

                 DB::table('photos')->where('name', 'bg.jpg')->delete();
                 Storage::delete('public/photos/bg.jpg');
               
            }

            $fileName = 'bg.jpg';

        $path = $req->file('bg')->storeAs('public/photos', $fileName);
       
        $img = Image::make(storage_path('app/public/photos/bg.jpg'))->resize(null, 450, function($constraint){
         $constraint->aspectRatio();
        })->save(storage_path('app/public/photos/bg.jpg'));  

        $newPhoto = new Photo;
        $newPhoto->name = $fileName;
        $newPhoto->path = $path;
        $newPhoto->save();
        return response('image saved' , 201);

        } else {

            return response('Image not found', 404);
        }

    }


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
    }
}
