<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Job;
use App\Models\College;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\CollegeAssigned;
use App\Models\CourseAssigned;
use App\Models\AssignExam;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class AdminController extends Controller

{
  public function index()
  {

    return view('admin/index');
  }
  public function addcourses(Request $request)
  {
    $courses=DB::table('courses')
               ->select('*')
               ->get();
               return view("admin/addcourses",['courses'=>$courses]);
  }

  
    public function addcourse(request $request)
    {
      
        $validated = $request->validate([
          
            
            'cname' => ['required','string','max:255'],
            /*'exam' => ['required'],
            'uni' => ['required'],*/
            
      ]);
      
      $addcourse=new Course();
      $addcourse->course_title=$request->cname;
    /*  $addcourse->university=$request->uni;
      $addcourse->entrance_exam=$request->exam;*/
      $addcourse->description=$request->description;
      $addcourse->save();
      if($addcourse)
      {
        return back()->with('status',"Course added successfully");
      }
      else{
        return back()->with('failed',"try again");
      }
    }
    public function addcollege($id)
    {
      $colleges=DB::table('college_assigned')
          ->join('colleges','colleges.id','college_assigned.college_id')
          ->join('users','users.id','colleges.user_id')
          ->select('college_assigned.*','users.name','colleges.university','colleges.state','colleges.district')
          ->where('college_assigned.course_id',$id)
          ->get();
      $allcolleges=College::join('users','users.id','colleges.user_id')->select('colleges.*','users.name')->get();
      return view('admin.addcollege',['colleges'=>$colleges,'courseid'=>$id,'acolleges'=>$allcolleges]);
    }
    public function savecollege(Request $request)
    {
          $validate=$request->validate([
            'courseid'=>['required'],
            'college'=>['required']
          ]);
          $collegeassign=new CollegeAssigned();
          $collegeassign->course_id=$request->courseid;
          $collegeassign->college_id=$request->college;
          $collegeassign->save();
          if($collegeassign)
          {
              return back()->with('status',"College Added successfully");
          }
          else
          {
            return back()->with('failed',"try again");

          }
    }
    public function deleteassignedcollege(Request $request)
  {
    $id=$request->dodelete;
    $result=CollegeAssigned::find($id)->delete();
    if($result)
    {
      return back()->with('status',"College deleted successfully");
      }
      else{
        return back()->with('failed',"try again");

    }
  }
  public function addexam($id)
    {
      $exams=DB::table('entranceexams')
          ->select('entranceexams.*')
          ->where('entranceexams.course_id',$id)
          ->get();
      return view('admin.addexam',['exams'=>$exams,'courseid'=>$id]);
    }
    public function saveexam(Request $request)
    {
          $validate=$request->validate([
            'courseid'=>['required'],
            'ename'=>['required']
          ]);
          $examassign=new AssignExam();
          $examassign->course_id=$request->courseid;
          $examassign->ename=$request->ename;
          $examassign->description=$request->description;
          $examassign->save();
          if($examassign)
          {
              return back()->with('status',"Exam Added successfully");
          }
          else
          {
            return back()->with('failed',"try again");

          }
    }
  public function deleteexam(Request $request)
  {
    $id=$request->dodelete;
    $result=AssignExam::find($id)->delete();
    if($result)
    {
      return back()->with('status',"Exam deleted successfully");
      }
      else{
        return back()->with('failed',"try again");

    }
  }
    public function deletecourse(Request $request)
  {
    $id=$request->dodelete;
    $result=Course::find($id)->delete();
    if($result)
    {
      return back()->with('status',"course deleted successfully");
      }
      else{
        return back()->with('failed',"try again");

    }
  }
  public function addinstructors(Request $request)
  {
    $instructors=DB::table('instructors')
               ->select('*')
               ->get();
               return view("admin/addinstructor",['instructors'=>$instructors]);
  }

  
    public function addinstructor(request $request)
    {
      
        $validated = $request->validate([
          
            
            'iname' => ['required','string','max:255'],
            'iquali' => ['required'],
            
            
      ]);
      $fileName = time().'.'.$request->file->extension();  
        $request->file->move(public_path('photos'), $fileName);
      $addinstructor=new Instructor();
      $addinstructor->name=$request->iname;
      $addinstructor->email=$request->imail;
      $addinstructor->contact_no=$request->iphone;
      $addinstructor->qualification=$request->iquali;
      $addinstructor->description=$request->idis;
      $addinstructor->photo=$fileName;
      $addinstructor->save();
      if($addinstructor)
      {
        return back()->with('status',"Instructor added successfully");
      }
      else{
        return back()->with('failed',"try again");
      }
    }
    public function deleteinstructor(Request $request)
    {
      $id=$request->dodelete;
      $result=Instructor::find($id)->delete();
      if($result)
      {
        return back()->with('status',"Instructor deleted successfully");
        }
        else{
          return back()->with('failed',"try again");
  
      }
    }
   
  

    
    public function getjobs()
    {
      /*$jobs=DB::table('jobs')->join('courses','courses.id','jobs.course_id')
               ->select('jobs.*','courses.course_title')
               ->get();*/
      $jobs=DB::table('jobs')->select('*')->get();

      $courses=Course::select('*')->get();
      return view("admin/addjob",['jobs'=>$jobs,'courses'=>$courses]);
    }
    public function savejob(Request $request)
    {
      
        $validated = $request->validate([
          
            
            'jname' => ['required','string','max:255'],
           // 'jcourse' => ['required'],
            'jdis' => ['required'],
            
      ]);
      
      $getjob=new Job();
      $getjob->name=$request->jname;
     // $getjob->course_id=$request->jcourse;
      $getjob->description=$request->jdis;
      $getjob->save();
      if($getjob)
      {
        return back()->with('status',"Job added successfully");
      }
      else{
        return back()->with('failed',"try again");
      }

    
  }
  public function deletejob(Request $request)
  {
    $id=$request->dodelete;
    $result=Job::find($id)->delete();
    if($result)
    {
      return back()->with('status',"job deleted successfully");
      }
      else{
        return back()->with('failed',"try again");

    }
  }
  public function assigncourse($id)
  {
    $acourses=CourseAssigned::join('courses','courses.id','course_assigned.course_id')->select('courses.course_title','course_assigned.*')
      ->where('course_assigned.job_id',$id)
      ->get();
    $courses=Course::select('*')->get();
    return view('admin.assigncourses',['acourses'=>$acourses,'jobid'=>$id,'courses'=>$courses]);
  }
  public function savejobcourse(Request $request)
  {
    $validate=$request->validate([
      'jcourse'=>['required'],
      'jobid'=>['required']
    ]);
    $courseassign=new CourseAssigned();
    $courseassign->job_id=$request->jobid;
    $courseassign->course_id=$request->jcourse;
    $courseassign->save();
    if($courseassign)
    {
        return back()->with('status',"Course Assigned successfully");
    }
    else
    {
      return back()->with('failed',"try again");

    }
  }
  public function deletejobcourse(Request $request)
  {
    $id=$request->dodelete;
    $result=CourseAssigned::find($id)->delete();
    if($result)
    {
      return back()->with('status',"Course deleted successfully");
      }
      else{
        return back()->with('failed',"try again");

    }
  }
  public function updatepassword(Request $request)
  {
    $validated=$request->validate([
      'cpassword'=>['required'],
      'password'=>['required','confirmed'],

    ]);
   
    if(!HASH::check($request->cpassword,auth()->user()->password))
    {
      return back()->with('error',"old password doesn't match");
      }
      $result=User::whereId(auth()->user()->id)->update([
        'password'=>HASH::make($request->password)]
      );
      if($result)
    {
      return back()->with('status',"password updated  successfully");
      }
      else{
        return back()->with('failed',"try again");

    }
    }
    public function viewstudent()
    {
      $students=DB::table('students')
               ->join('users','users.id','students.user_id')
               ->select('students.*','users.name','users.email')
               ->get();
      return view("admin/viewstudent",['students'=>$students]);
    }
    public function getstudent($id)
    {
        $student=Student::join('users','users.id','students.user_id')->where('students.id',$id)->select('students.*','users.name','users.email')->first();
        return view('admin.viewmorestudent',['students'=>$student]);
      
    }
    public function deletestudent(Request $request)
  {
    $id=$request->dodelete;
    $result=Student::find($id)->delete();
    if($result)
    {
      return back()->with('status',"student deleted successfully");
      }
      else{
        return back()->with('failed',"try again");

    }
  }
  public function viewcollege()
    {
      $colleges=DB::table('colleges')
               ->join('users','users.id','colleges.user_id')
               ->select('colleges.*','users.name','users.email')
               ->get();
      return view("admin/viewcollege",['colleges'=>$colleges]);
    }
    public function getcollege($id)
    {
        $college=College::join('users','users.id','colleges.user_id')->where('colleges.id',$id)->select('colleges.*','users.name','users.email')->first();
        return view('admin.viewmorecollege',['colleges'=>$college]);
      
    }
    public function deletecollege(Request $request)
    {
      $id=$request->dodelete;
      $result=College::find($id)->delete();
      if($result)
      {
        return back()->with('status',"College deleted successfully");
        }
        else{
          return back()->with('failed',"try again");
  
      }
    }
    public function updatecollegestatus(Request $request)
    {
      $id=$request->doupdate;
      $result=College::where('id',$id)->update(['status'=>$request->clstatus]);
      if($result)
      {
        return back()->with('status',"College Status Updated successfully");
        }
        else{
          return back()->with('failed',"try again");
  
      }
    }
    //updatestudentstatus
    public function updatestudentstatus(Request $request)
    {
      $id=$request->doupdate;
      $result=Student::where('id',$id)->update(['status'=>$request->clstatus]);
      if($result)
      {
        return back()->with('status',"Student Status Updated successfully");
        }
        else
        {
          return back()->with('failed',"try again");
  
      }
    }
  }

  
      
     
      
