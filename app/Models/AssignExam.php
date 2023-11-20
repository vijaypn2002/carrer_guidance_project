<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignExam extends Model
{
    use HasFactory;
    protected $table='entranceexams';
    protected $filliable=[
        'course_id','ename',
    ];
}
