<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



// // rotta che va a puntare al controller
// Route::get('posts', 'Api\PostController@index');

// // rotta chiamata api singolo post in base allo slug
// Route::get('{slug}', 'Api\PostController@show');

Route::namespace('Api')
   ->group(function(){
      Route::get('/posts', 'PostController@index');
      Route::get('posts/{slug}', 'PostController@show');
      Route::get('posts/category/{slug}', 'PostController@PostByCategory');
      Route::get('posts/tag/{slug}', 'PostController@PostByTag');
      Route::post('contacts/', 'ContactController@store');
   });