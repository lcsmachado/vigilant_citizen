<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function Verify($token){
      $user= User::where('confirmation_code', $token)->firstOrFail();

      $user->confirmed=1;
      $user->confirmation_code=null;
      $user->save();

    }
}
