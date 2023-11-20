<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\College;
use App\Models\Job;
use App\Models\CourseAssigned;
use App\Models\CollegeAssigned;
use App\Models\AssignExam;
use App\Models\Instructor;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;
class GuestController extends Controller

{
    public function students(request $request)
    {
      
        $validated = $request->validate([
          
            
            'sname' => ['required','string','max:255'],
            'sphone' => ['required'],
            'email' => ['required','email','unique:users'],
            'squali' => ['required'],
            'password' => ['required','confirmed'],
      ]);
      $user=new User();
      $user->name=$request->sname;
      $user->email=$request->email;
      $user->password=Hash::make($request->password);
      $user->user_type=2;
      $user->save();
      $students=new Student();
      $students->user_id=$user->id;
      $students->contact_no=$request->sphone;
      $students->Qualification=$request->squali;
      $students->save();
      
      
     
      
      
      if($students)
      {
        return back()->with('status',"Student added successfully");
      }
      else{
        return back()->with('failed',"try again");
      }
      
        
       
    }
    public function colleges(request $request)
    {
      
        $validated = $request->validate([
            
            'cname' => ['required','string','max:255'],
            'cphone' => ['required'],
            'email' => ['required','email','unique:users'],
            'cadd' => ['required','string','max:255'],
            'cstate' => ['required'],
            'cdis' => ['required'],
            'uni' => ['required','string','max:255'],
            'password' => ['required','confirmed'],
      ]);
      $user=new User();
      $user->name=$request->cname;
      $user->email=$request->email;
      $user->password=Hash::make($request->password);
      $user->user_type=3;
      $user->save();
      $colleges=new college();
      $colleges->user_id=$user->id;
      $colleges->contact_no=$request->cphone;
      $colleges->address=$request->cadd;
      $colleges->state=$request->cstate;
      $colleges->district=$request->cdis;
      $colleges->university=$request->uni;
      $colleges->save();
      if($colleges)
      {
        return back()->with('status',"college added successfully");
      }
      else{
        return back()->with('failed',"try again");
      }
    } 
  public function postLogin(Request $request)
  {
      $request->validate([
          'email' => 'required',
          'password' => 'required',
      ]); 
      $remember_me  = ( !empty( $request->remember) )? TRUE : FALSE;

      if(Auth::attempt(['email' => $request->email, 'password' => $request->password],$remember_me))
      {
          if(Auth::user()->user_type==1){
              return redirect('adminhome')->withSuccess('You have Successfully loggedin');
          }
          else if(Auth::user()->user_type==2){
             return redirect('/')->withSuccess('You have Successfully loggedin');
             
          }
          else{
              return redirect('/')->withSuccess('You have Successfully loggedin');
          
          }
      }
      else{
          return redirect("login")->with('failed','Error! You have entered invalid credentials');
      }
  }
  public function destination()
  {
    $destinations=Job::select('*')->get();
    return view('destination',['destinations'=>$destinations]);
  }
  public function viewpath(Request $request)
  {
    session(['jobid' => $request->jobid]);
    $courses=CourseAssigned::join('courses','courses.id','course_assigned.course_id')->select('courses.course_title','course_assigned.*')->where('course_assigned.job_id',$request->jobid)->get();
    return view('viewpath',['courses'=>$courses]);
  }
  public function viewmorepath($id)
  {
    $job = session('jobid');
    $courses=CourseAssigned::join('courses','courses.id','course_assigned.course_id')->select('courses.course_title','course_assigned.*')->where('course_assigned.job_id',$job)->get();
    $eexams=AssignExam::select('*')->where('course_id',$id)->get();
    $colleges=CollegeAssigned::join('colleges','colleges.id','college_assigned.college_id')->join('users','users.id','colleges.user_id')->select('college_assigned.*','users.name','colleges.university')->where('college_assigned.course_id',$id)->get();
    return view('viewpath',['courses'=>$courses,'exams'=>$eexams,'colleges'=>$colleges]);
  }
  public function logout() {
    Session::flush();
    Auth::logout();

    return Redirect('login');
}
public function viewinstructor()
{
  $instructors=Instructor::select('*')->get();
  return view('trainer',['instructors'=>$instructors]);
}
}   