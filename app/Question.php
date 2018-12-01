<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected  $table = 'questions';
    protected $fillable = [
        'question',
        'a',
        'b',
        'c',
        'd',
        'correct_option',
        'course_id',
    ];
     protected $hidden = ['correct_option',];
}
