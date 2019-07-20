<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use \Illuminate\Support\Str;

class AdminModel extends Authenticatable
{
    //
    protected $table = 'admin_users';

    protected $fillable = [
        'name',
        'email',
        'password'
    ];


    protected  $hidden = ['password','remember_token'];

    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($user) {
            $user->activation_token = Str::random(10);
        });
    }
}