<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
    protected  $fillable = [
        'email',
        'fist_name',
        'last_name',
        'password',
        'matric_no',

    ];
}
