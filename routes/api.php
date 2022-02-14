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
   ->prefix('posts')
   ->group(function(){
      Route::get('/', 'PostController@index');
      Route::get('{slug}', 'PostController@show');
      Route::get('/category/{slug}', 'PostController@PostByCategory');
      Route::get('/tag/{slug}', 'PostController@PostByTag');
   });