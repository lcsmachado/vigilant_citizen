<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Notifications\Notifiable;
use App\Notifications\forgotPassword;
use App\Models\User;
use App\Http\Resources\User as UserResources;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = $request->isMethod('put') ? User::findOrFail($request->$id) : new User;

      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->password = bcrypt($request->input('password'));
      $user->confirmation_code = str_random(30);

      $user->sendVerificationCode();
        
      if ($user->save()) {
        return new UserResources($user);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::findOrFail($id);

        return new UserResources($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $user = User::findOrFail($id);

      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->password = bcrypt($request->input('password'));

      if ($user->save()) {
        return new UserResources($user);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::findOrFail($id);

      $user->status = 0;
      $user->deleted = 1;

      if ($user->save()) {
        return new UserResources($user);
      }
    }

    public function forgotPassword($email){
      //Enviar email para recuperação de senha
      $user= User::where('email', $email)->firstOrFail();
      $user->token = str_random(30);

      if ($user->save()) {
        $user->sendforgotPasswordEmail();
        return new UserResources($user);
      }

    }

    public function resetPassword(Request $request, $token){
      //REceber token e usá-lo para redifiner a senha
      $user= User::where('token', $token)->firstOrFail();
      $user->password = bcrypt($request->input('password'));

      if ($user->save()) {
        return new UserResources($user);
      }
    }
}
