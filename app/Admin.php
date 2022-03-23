<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent;
use Illuminate\Foundation\Auth\User as Authentificatable; 

class Admin extends Authentificatable
{
    //
    use Notifiable;
    protected $guard = 'admin';
    protected $fillable = [
    	'name','type','mobile','email','password','image','status','create_at','updated_at',
    ];
    protected $hidden = [
    	'passwaord','remember_token',
    ];
}
 