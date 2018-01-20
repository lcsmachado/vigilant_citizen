<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
class Role extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name', 'admin', 'editor','visitor'
    ];

    public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
