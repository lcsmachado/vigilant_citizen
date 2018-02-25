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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('painel')->group(function () {

    //Admins routes
    Route::group([
       'middleware' => ['auth:admin','roles'],
       'roles'      => ['Admin'],
       'prefix'     => 'admin'
    ],function () {
        Route::get('/create', 'AdminController@create')->name('admin.create');
        Route::post('/create', 'AdminController@store')->name('admin.store');
        Route::get('/editar/{id}', 'AdminController@edit')->name('admin.edit');
        Route::put('/update/{id}', 'AdminController@update')->name('admin.update');
        Route::get('/show/{id}', 'AdminController@show')->name('admin.show');
        Route::delete('/delete/{id}', 'AdminController@destroy')->name('admin.destroy');
        Route::get('/lixeira','AdminController@trash')->name('admin.trash');
        Route::get('/restaurar/{id}','AdminController@restore')->name('admin.restore');
        Route::get('/', 'AdminController@index')->name('admin');
    });

    //Routers to Categories
    Route::group([
        'middleware' => ['auth:admin','roles'],
        'roles'      => ['Admin'],
        'prefix'     => 'categorie'
    ],function () {
        Route::get('/create', 'CategorieController@create')->name('categorie.create');
        Route::post('/create', 'CategorieController@store')->name('categorie.store');
        Route::get('/{id}/edit', 'CategorieController@edit')->name('categorie.edit');
        Route::put('/{id}/update', 'CategorieController@update')->name('categorie.update');
        Route::get('/{id}/restore', 'CategorieController@restore')->name('categorie.restore');
        Route::get('/trash','CategorieController@trash')->name( 'categorie.trash');
        Route::get('/{id}/show', 'CategorieController@show')->name('categorie.show');
        Route::get('/{id}/showRes', 'CategorieController@show')->name('categorie.showRes');
        Route::delete('/{id}/delete', 'CategorieController@destroy')->name('categorie.destroy');
        Route::get('/', 'CategorieController@index')->name('categorie');
    });

    // Login routes
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('painel.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('painel.login.submit');

    // Password reset routes
    Route::post('/password/email','Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('painel.password.email');
    Route::get('/password/reset','Auth\AdminForgotPasswordController@showLinkRequestForm')->name('painel.password.request');
    Route::post('/password/reset','Auth\AdminResetPasswordController@reset');
    Route::get('/password/reset/{token}','Auth\AdminResetPasswordController@showResetForm')->name('painel.password.reset');


    Route::get('/',[
        'uses' => 'PainelController@index',
        'middleware' => ['auth:admin'],
        'roles' => ['Admin', 'Editor']])->name('painel');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
