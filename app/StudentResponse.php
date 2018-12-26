<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentResponse extends Model
{
    protected $table =  'response';
    protected $fillable =[
        'student_id',
        'test_id',
        'question_id',
        'response',
    ];
}
