<?php

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
// les routes d'authentification (Se connecter, S'inscrire ...)
Auth::routes();
// Les routes publiques
// Page d'accueil
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');



// Les routes protégées
Route::group(['middleware' => ['auth']], function() {
    Route::resource('Composition', 'CompositionController')->except(['create']);
        Route::get('Composition/create/{id}', 'CompositionController@create')->name('Composition.create');
});
