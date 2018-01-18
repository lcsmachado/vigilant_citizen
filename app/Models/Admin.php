<?php

namespace App\Models;
use App\Models\Role;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false;

    /*
    * Return the role of the use  
    */
    public function role(){
        return $this->hasOne(Role::class,'id','role_id')->first();
    }
}
