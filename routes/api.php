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


// rotta raggiungibile con -> http://127.0.0.1:8000/api/posts
// nell'uri -> 'api' è sottinteso
// in action -> 'api' va specificato
Route::get('/posts', 'Api\PostController@index');
Route::get('/posts/{post}', 'Api\PostController@show');  // qualsiasi numero mettiamo -> http://127.0.0.1:8000/api/posts/13 -> cercherà il post con l'id corrispondente (se esiste)
Route::post('/posts', 'Api\PostController@store');
Route::post('/contacts', 'Api\ContactController@store');


