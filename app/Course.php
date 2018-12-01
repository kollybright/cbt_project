<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'course';
    protected $fillable = [
        'course_code',
        'course_tile',
        'lecturer_id',
        'semester'
    ];
}
