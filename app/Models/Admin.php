<?php

namespace App\Models;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'email', 'password','status','role_id'
    ];

    public  $rules =  [
                'name'     => 'required|min:3|max:100',
                'email'    => 'required|email|unique:admins',
                'password' => 'required|min:8',
                'role_id'     => 'required',
                'status'     => 'required'
            ];




    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    * Return the role of the use  
    */
    public function role(){
        return $this->hasOne(Role::class,'id','role_id')->first();
    }


}
