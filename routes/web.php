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
    Route::resource('Composition', 'CompositionController')->except(['create'])->middleware('can:compose');
        Route::get('Composition/create/{Composition}', 'CompositionController@create')->name('Composition.create')->middleware('can:admin');
        Route::get('Composition/{Composition}/edit', 'CompositionController@edit')->name('Composition.edit')->middleware('can:admin');
});
