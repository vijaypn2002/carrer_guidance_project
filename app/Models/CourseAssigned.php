<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseAssigned extends Model
{
    use HasFactory;
    protected $table='course_assigned';
    protected $filliable=[
        'job_id','course_id',
    ];
  
  public $timestamp=true;
}
