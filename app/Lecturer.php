<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected  $table = 'lecturer';
    protected $fillable = [
        'email',
        'password',
        'fist_name',
        'last_name',


    ];

    protected $hidden = [

        'password,remember_token',
    ];
}
