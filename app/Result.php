<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'result' ;
    protected $fillable = [
        'student_id',
        'test_id',
        'score',
        'total',
    ];
}
