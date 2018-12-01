<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{

    protected  $table='registration';
    protected  $fillable=[
        'student_id',
        'test_id',
    ];

}
