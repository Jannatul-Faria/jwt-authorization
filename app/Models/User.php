<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class User extends Model
{
   

    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'password',
        'mobile',
        'otp',
    ];

    protected  $attributes  = [
        'otp' => '0'
    ];



  
}