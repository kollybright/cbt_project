<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'test';
    protected  $fillable =[
        'course_id',
        'start_time',
        'duration',
        'no_of_question',
        'session',
    ];
}
