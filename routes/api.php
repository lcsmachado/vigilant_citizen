<?php

use Illuminate\Http\Request;

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
Route::middleware(['cors'])->post('v1/login', 'Api\AuthenticateController@authenticate')->name('api.login');

Route::middleware(['auth:api', 'cors'])->get('/user', function (Request $request) {
    return $request->user();
});

//Metohd used to show User Profile
Route::get('user/{id}','UserController@show');

//Method used to create a new user
Route::post('user','UserController@store');

//Method used to update User Profile
Route::put('user/{id}','UserController@update');

//Method used to verify User Email
Route::get('/verify/{token}', 'VerifyController@verify')->name('verify');

//Method user to resend de User Account Verification Email 
Route::get('/verify/resend', 'VerifyController@resend')->name('verify.resend');

//Method used to send an email with a Link for User's reset Password
Route::get('/forgotPassword/{email}', 'UserController@forgotPassword')->name('forgot');

//Method used to reset the User Password
Route::put('/resetPassword/{token}', 'UserController@resetPassword')->name('reset');

