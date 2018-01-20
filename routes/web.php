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

    Route::get('/', 'PainelController@index')->name('painel');
});
