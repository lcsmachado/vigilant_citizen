<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\forgotPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\VerifyEmail;

class User extends Model
{
  use Notifiable;
  protected $fillable=[
      'name','email','password','provider','deleted','status','confirmed','confirmation_code','token','credentials'
  ];
  public  $rules =  [
      'name'     => 'required|min:3|max:45',
      'email'    => 'required|min:3|max:45',
      'password' => 'required|min:8|max:45',
  ];
  protected $hidden = [
      'password', 'remember_token',
  ];

  public function verified()
  {
    return $this->confirmation_code === null;
  }

  public function sendVerificationCode()
  {
    $this->notify(new VerifyEmail($this));
  }

  public function sendforgotPasswordEmail()
  {
    $this->notify(new forgotPassword($this));
  }
}
