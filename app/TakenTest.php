<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TakenTest extends Model
{
    protected $table = 'taken_test';
    protected $fillable = [
        'student_id',
        'test_id'
    ];
}
