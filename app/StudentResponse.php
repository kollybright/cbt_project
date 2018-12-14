<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentResponse extends Model
{
    protected $fillable =[
        'id',
        'student_id',
        'test_id',
        'course_id',
        'question_id',
        'response'
    ];
}
