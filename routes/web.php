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

// rotta che rimanda alla view pubblica welcome.blade
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


// admin routes group -> rotte che rimandano alla view privata dell'user login in /admin
// middelware -> si interpone tra server (che riceve la richiesta dal browser) e controller ->
// si occupa di gestire/autorizzare/non autorizzare la richiesta del server al controller
Route::middleware('auth')
    ->namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', 'HomeController@index')
            ->name('home');
    }
);
// /admin routes group

// ALERT: ROTTA CHE VA MESSA SEMPRE ALLA FINE DELLE ALTRE ROTTE PERCHE' BLOCCA LE SUCCESSIVE
// rotta generica/dinamica che rimanda alla view pubblica home.blade (con app.vue) indipendentemente da qualsiasi inserimento nell'uri dopo / 
// -> http://127.0.0.1:8000/provaprovaciao
Route::get("{any?}", function () {
    return view("home");
})->where("any", ".*");
