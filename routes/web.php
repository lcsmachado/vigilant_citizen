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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('painel')->group(function () {

    //Routers to Admins
    Route::prefix('admin')->group(function () {
        Route::get('/create', 'AdminController@create')->name('admin.create');
        Route::post('/create', 'AdminController@store')->name('admin.store');
        Route::get('/{id}/edit', 'AdminController@edit')->name('admin.edit');
        Route::put('/{email}/update', 'AdminController@update')->name('admin.update');
        Route::get('/{email}/show', 'AdminController@show')->name('admin.show');
        Route::delete('/{email}/delete', 'AdminController@destroy')->name('admin.destroy');
        Route::get('/', 'AdminController@index')->name('admin');
    });
    //Routers to Categories
    Route::prefix('categorie')->group(function () {
        Route::get('/create', 'CategorieController@create')->name('categorie.create');
        Route::post('/create', 'CategorieController@store')->name('categorie.store');
        Route::get('/{id}/edit', 'CategorieController@edit')->name('categorie.edit');
        Route::put('{id}/update', 'CategorieController@update')->name('categorie.update');
        Route::get('/{id}/show', 'CategorieController@show')->name('categorie.show');
        Route::delete('/{id}/delete', 'CategorieController@destroy')->name('categorie.destroy');
        Route::get('/', 'CategorieController@index')->name('categorie');
    });

    Route::get('/', 'PainelController@index')->name('painel');
});
