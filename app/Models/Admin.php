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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password','status','role_id'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    * Return the role of the use
    */
    public function role(){
        return $this->hasOne(Role::class,'id','role_id')->first();
    }

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

}
