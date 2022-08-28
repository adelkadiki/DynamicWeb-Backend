<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Paragraph;
use App\Models\Headline;
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

    // Side image function
    public function sideImageUploading(Request $req){

        if($req->hasFile('sideImage')) {

            $photo = DB::table('photos')->where('name', 'sideImage.jpg')->first();
            
            if(Storage::exists('public/photos/sideImage.jpg') && $photo){

                 DB::table('photos')->where('name', 'sideImage.jpg')->delete();
                 Storage::delete('public/photos/sideImage.jpg');
               
            }

            $fileName = 'sideImage.jpg';

        $path = $req->file('sideImage')->storeAs('public/photos', $fileName);
       
        $img = Image::make(storage_path('app/public/photos/sideImage.jpg'))->resize(350, null, function($constraint){
         $constraint->aspectRatio();
        })->save(storage_path('app/public/photos/sideImage.jpg'));  

        $newPhoto = new Photo;
        $newPhoto->name = $fileName;
        $newPhoto->path = $path;
        $newPhoto->save();
        return response('image saved' , 201);

        } else {

            return response('Image not found', 404);
        }


    }


    // First paragraph function submiting

    public function firstPargraph(Request $req){


                       $line = DB::table('headlines')->where('title', 'first headline')->first();

                        if($line){

                            DB::table('headlines')->where('title', 'first headline')->delete();
                        }   

                        $paragraph = DB::table('paragraphs')->where('title', 'first paragraph')->first();

                    
                        if($paragraph){
   
                           DB::table('paragraphs')->where('title', 'first paragraph')->delete();
                           }


            if($req->paragraph){

               
            
                        $paragraph = new Paragraph;
                        $paragraph->title = 'first paragraph';
                        $paragraph->paragraph = $req->paragraph;
                        $paragraph->save();

                        
                        if($req->headline){
                                       
                                               
                                 $headline = new Headline;
                                 $headline->title = 'first headline';
                                 $headline->line = $req->headline;
                                 $headline->save(); 

                                   } 


                        return response('First paragraph saved' , 201);
                           
                             } else {

                                     return response('Error saving first paragraph' , 403);
                                    }
           
    }

    // Get first paragraph text
    public function getFirstParagraph(){

            $content = DB::table('paragraphs')->where('title', 'first paragraph')->first();
            
            if($content){
                return response($content->paragraph, 201);
            } else {

                return response('', 201);    
            }
            
    }

    // Side paragraph uploading
    public function sideParagraphUploading(Request $req){

        if($req->sideParag){

            $paragraph = DB::table('paragraphs')->where('title', 'side paragraph')->first();

             if($paragraph){

                DB::table('paragraphs')->where('title', 'side paragraph')->delete();
                }
    
                $paragraph = new Paragraph;
                $paragraph->title = 'side paragraph';
                $paragraph->paragraph = $req->sideParag;
                $paragraph->save();

                return response('Side paragraph saved' , 201);
                   
                     } else {

                             return response('Error saving first paragraph' , 403);
                            }
   
    }

    // Get side paragraph
    public function getSideParagraph(Request $req){

        $content = DB::table('paragraphs')->where('title', 'side paragraph')->first();
            
            if($content){
                return response($content->paragraph, 201);
            } else {

                return response('', 201);    
            }
    }


    // Background image headline
    public function backgroundImageLine(Request $req){

            if($req->line){

                $headline = DB::table('headlines')->where('title', 'background image line')->first();
                
                if($headline){
                    DB::table('headlines')->where('title', 'background image line')->delete();
                }

                        $headline = new Headline;
                        $headline->title = 'background image line';
                        $headline->line = $req->line;
                        
                        if($headline->save()){
                            return response('Background image line saved' , 201);
                        }
            } else {

                response('Headline not found', 403);
            }

    }

    // Get background image headline
    public function getBackgroundImageHeadline(){

        $headline = DB::table('headlines')->where('title', 'background image line')->first();

         if($headline){
             return response($headline->line, 201);
         
            }else {

              return response('', 201);  
         }       
    }

    public function getAllHeadlines(){

        $headlines = Headline::all();
        

        return $headlines;

    }

    public function getAllParagraphs(){

        $paragraphs = Paragraph::all();

        return $paragraphs;
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
