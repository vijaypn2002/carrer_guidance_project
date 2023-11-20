<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeAssigned extends Model
{
    use HasFactory;
    protected $table='college_assigned';
    protected $filliable=[
        'college_id','course_id',
    ];
  
  public $timestamp=true;
    
}
