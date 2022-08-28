<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Image;


class GalleryController extends Controller
{
    //

    public function newImage(Request $req){

        $code = Str::random(7); 
        $folder = $code;
        // saving the product info

        $description = $req->description;
        $price = $req->price;
    

        // saving the file
        $fileName = 'image1.jpg';

        $path = $req->file('image1')->storeAs('public/gallery/'.$folder, $fileName);
       
         Image::make(storage_path('app/public/gallery/'.$code.'/image1.jpg'))->resize(null, 100, function($constraint){
         $constraint->aspectRatio();
        })->save(storage_path('app/public/gallery/'.$code.'/image1.jpg'));  
        

         $gallery = new Gallery;
         $gallery->description = $description;
         $gallery->price = $price;
         $gallery->code = $code;
         $gallery->path = $path;
         $gallery->save();
         return response('image saved' , 201);
        
        
    }
}
