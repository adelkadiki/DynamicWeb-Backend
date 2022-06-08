<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/photo', [PhotoController::class, 'photoUpload']);
Route::post('/bg', [PhotoController::class, 'backGroundImage']);
Route::post('/firstPargraph', [PhotoController::class, 'firstPargraph']);
Route::get('/getFirstParagraph', [PhotoController::class, 'getFirstParagraph']);
Route::post('/backgroundImageLine', [PhotoController::class, 'backgroundImageLine']);
Route::get('/getBackgroundImageHeadline', [PhotoController::class, 'getBackgroundImageHeadline']);
Route::post('/sideImageUploading', [PhotoController::class, 'sideImageUploading']);
Route::post('/sideParagraphUploading', [PhotoController::class, 'sideParagraphUploading']);
Route::get('/getSideParagraph', [PhotoController::class, 'getSideParagraph']);

Route::get('/test', function(){

    $url = storage_path('app');
    return response($url, 200);
    //return 'seccesful';
}); 

Route::group(['middleware'=> ['auth:sanctum']], function(){
    
       

    Route::post('/logout', [AuthController::class, 'logout']);
    

} );

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
