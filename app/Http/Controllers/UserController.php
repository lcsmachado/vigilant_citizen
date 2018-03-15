<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
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
    
      $validator = Validator::make($request->all(), [
        'name'     => 'required|min:3|max:45',
        'email'    => 'required|min:3|max:45',
        'password' => 'required|min:8|max:45',
      ]);

      if($validator->fails()){
        return response()->json($validator->messages(), 200);
      }else{
          if ($user->save()) {
          $user->sendVerificationCode();
          $notification = 'Cadastro realizado com sucesso.';
          return response()->json($notification);
        }else{
          $notification = 'Falha ao cadastrar.';
          return response()->json($notification);
        }
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

      $validator = Validator::make($request->all(), [
        'name'     => 'required|min:3|max:45',
        'email'    => 'required|min:3|max:45',
        'password' => 'required|min:8|max:45',
      ]);

      if($validator->fails()){
        return response()->json($validator->messages(), 200);
      }else{
          if ($user->save()) {
          $user->sendVerificationCode();
          $notification = 'Cadastro realizado com sucesso.';
          return response()->json($notification);
        }else{
          $notification = 'Falha ao cadastrar.';
          return response()->json($notification);
        }
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

    public function messages(){
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.min' => 'O nome deve ter no mínimo 3 caracteres.',
            'name.max' => 'O nome deve ter no máximo 45 caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.min' => 'O email deve ter no mínimo 3 caracteres.',
            'email.max' => 'O email deve ter no máximo 45 caracteres.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.min' => 'A senha deve ter no mínimo 3 caracteres.',
            'password.max' => 'A senha deve ter no máximo 45 caracteres.'
        ];

    }
    
}
