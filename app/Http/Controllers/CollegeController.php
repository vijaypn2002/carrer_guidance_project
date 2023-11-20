<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\College;
use App\Models\User;
use App\Models\CollegeAssigned;
use App\Models\Course;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CollegeController extends Controller
{
   public function editprofile()
   {
       $pdata=College::join('users','users.id','colleges.user_id')->select('colleges.*','users.name','users.email')->where('colleges.user_id',auth::user()->id)->first();
       return view('editprofile',['pdata'=>$pdata]);
   }
   public function updateprofile(Request $request)
   {
    $validated = $request->validate([
        'cname' => ['required'],
        'university' => ['required'],
        'state' => ['required'],
        'district' => ['required'],
        'cno' => ['required'],
        'address' => ['required'],
    ]);
    $update=College::where('id',$request->cid)->update(['university'=>$request->university,'state'=>$request->state,'district'=>$request->district,'contact_no'=>$request->cno,'address'=>$request->address]);
    if($update)
      {
        return back()->with('status',"Your Profile updated successfully");
      }
      else{
        return back()->with('failed',"try again");
      }
   }
   public function editcourses()
   {
       $acourses=Course::select('*')->get();
       $college=College::select('*')->where('user_id',auth::user()->id)->first();
       $courses=CollegeAssigned::join('courses','courses.id','college_assigned.course_id')->select('college_assigned.*','courses.course_title')->where('college_assigned.college_id',$college->id)->get();
       return view('editcourses',['courses'=>$courses,'acourses'=>$acourses]);

   }
   public function deletecourse(Request $request)
   {
       $delete=CollegeAssigned::where('id',$request->pdelete)->delete();
       if($delete)
      {
        return back()->with('status',"Your Course deleted successfully");
      }
      else{
        return back()->with('failed',"try again");
      }
   }
   public function addcourse(Request $request)
   {
        $validate=$request->validate([
            'course_id'=>['required','unique:college_assigned']
        ]);
        $college=College::select('*')->where('user_id',auth::user()->id)->first();

        $collegeassign=new CollegeAssigned();
        $collegeassign->course_id=$request->course_id;
        $collegeassign->college_id=$college->id;
        $collegeassign->save();
        if($collegeassign)
        {
              return back()->with('status',"Course Added successfully");
        }
        else
        {
            return back()->with('failed',"try again");

        }
   }
   public function changepassword()
   {
       return view('changepassword');
   }
   public function updatepassword(Request $request)
   {
     $validated=$request->validate([
       'cpassword'=>['required'],
       'password'=>['required','confirmed'],
 
     ]);
    
     if(!HASH::check($request->cpassword,auth()->user()->password))
     {
       return back()->with('failed',"old password doesn't match");
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
}

