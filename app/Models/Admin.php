<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Notifications\AdminResetPasswordNotification;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    public $timestamps = false;

<<<<<<< HEAD
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

=======
>>>>>>> 9fe7ea07e6febddd72120e69a9544f7d1f391d04
    protected $fillable = [
        'name', 'email', 'password','status','role_id'
    ];

<<<<<<< HEAD

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
=======
    public  $rules =  [
                'name'     => 'required|min:3|max:100',
                'email'    => 'required|email|unique:admins',
                'password' => 'required|min:8',
                'role_id'     => 'required',
                'status'     => 'required'
            ];




>>>>>>> 9fe7ea07e6febddd72120e69a9544f7d1f391d04
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    * Return the role of the use
    */
    public function role(){
        return $this->hasOne(Role::class,'id','role_id')->first();
    }

<<<<<<< HEAD
    public  $rules =  [
        'name'     => 'required|min:3|max:45',
        'email'    => 'required|max:145|email|unique:admins',
        'password' => 'confirmed|required|min:6',
        'role_id'     => 'required',
        'status'     => 'required'
    ];

    public function hasAnyRole($roles){
        if(is_array($roles)){

            foreach($roles as $role){

                if($this->hasRole($role)){
                    return true;
                }
            }

        }else{

            if($this->hasRole($roles)){
                return true;
            }
        }

        return false;
    }

    public function hasRole($role){


        if(Role::where('name',$role)->first()->id == Auth::user()->role_id){
            return true;
        }

        return false;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
=======
>>>>>>> 9fe7ea07e6febddd72120e69a9544f7d1f391d04

}
