<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable=[
        'name','description','deleted','status',
    ];
    public  $rules =  [
        'name'     => 'required|min:3|max:45',
        'description'    => 'required|min:3|max:45',
        'status'     => 'required'
    ];
}
