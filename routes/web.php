<?php

use Illuminate\Support\Facades\Route;

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

// rotta che rimanda alla view welcome.blade
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// admin routes group -> rotte che rimandano alla view dell'user login in /admin
Route::middleware('auth')
->namespace('Admin')
->prefix('admin')
->name('admin.')
->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
});
// /admin routes group


// rotta che rimanda alla view home.blade (con app.vue) indipendentemente da qualsiasi inserimento nell'uri dopo / 
// -> http://127.0.0.1:8000/provaprovaciao
Route::get("{any?}", function () {
    return view("home");
})->where("any", ".*");
