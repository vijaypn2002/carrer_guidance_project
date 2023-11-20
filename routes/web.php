<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name('/');
Route::get('/aboutus', function () {
    return view('aboutus');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('registration', function () {
    return view('registration');
})->name('registration');
Route::get('trainer',[App\Http\Controllers\GuestController::class,'viewinstructor'])->name('trainer');
Route::get('/student', function () {
    return view('student')->name('student');
});
Route::get('/instructor', function () {
    return view('instructor');
});
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/student', function () {
    return view('student');
    
})->name('student');
Route::get('/aboutus', function () {
    return view('aboutus');
})->name('aboutus');
Route::get('/destination',[App\Http\Controllers\GuestController::class,'destination'])->name('destination');
Route::post('viewpath',[App\Http\Controllers\GuestController::class,'viewpath'])->name('viewpath');
Route::get('viewmorepath/{id}',[App\Http\Controllers\GuestController::class,'viewmorepath'])->name('viewmorepath');

Route::get('adminregistration',[App\Http\Controllers\AdminRegistrationController::class,'index'])->name('adminregistration'); 
Route::post('student',[App\Http\Controllers\GuestController::class,'students'])->name('student');
Route::post('college',[App\Http\Controllers\GuestController::class,'colleges'])->name('college');
Route::post('login',[App\Http\Controllers\GuestController::class,'postLogin'])->name('postlogin');
Route::get('logout',[App\Http\Controllers\GuestController::class,'logout'])->name('logout'); 
Route::post('postadminform',[App\Http\Controllers\AdminRegistrationController::class,'save'])->name('postadminform');
    

Route::group(['middleware' => ['auth','prevent-back-history']],function(){

    Route::get('/adminhome', function () {
        return view('admin/index');
    })->name('adminhome');
    Route::get('/search', function () {
        return view('search');
    })->name('search');
    Route::get('admin.viewcollege', function () {
        return view('admin/viewcollege');
    })->name('admin.viewcollege');
    Route::get('admin.viewstudent', function () {
        return view('admin/viewstudent');
    })->name('admin.viewstudent');
    
    Route::get('admin.viewmorecollege', function () {
        return view('admin/viewmorecollege');
    })->name('admin.viewmorecollege');
    
    Route::get('admin.addcourses',function () {
        return view('admin/addcourses');
    })->name('admin.addcourses');

    Route::get('admin.addinstructor',function () {
        //return view('admin/addinstructor');
    })->name('admin.addinstructor');
    
    Route::get('admin.change', function () {
        return view('admin/change');
    })->name('admin.change');
    
    Route::get('admin.addjob',[App\Http\Controllers\AdminController::class,'getjobs'])->name('admin.addjob'); 
    Route::post('admin.savejob',[App\Http\Controllers\AdminController::class,'savejob'])->name('admin.savejob');
    Route::post('admin.addjobs',[App\Http\Controllers\AdminController::class,'deletejob'])->name('admin.deletejob');
    Route::post('admin.updatepassword',[App\Http\Controllers\AdminController::class,'updatepassword'])->name('admin.updatepassword');
    Route::get('admin.addcourses', [App\Http\Controllers\AdminController::class, 'addcourses'])->name('admin.addcourses');
    Route::post('admin.addcourses', [App\Http\Controllers\AdminController::class, 'addcourse'])->name('admin.addcourses');
    Route::post('admin.addcourse',[App\Http\Controllers\AdminController::class,'deletecourse'])->name('admin.deletecourse');
    Route::get('admin.addcollege/{id}',[App\Http\Controllers\AdminController::class,'addcollege'])->name('admin.addcollege'); 
    Route::post('admin.savecollege',[App\Http\Controllers\AdminController::class,'savecollege'])->name('admin.savecollege');
    Route::post('admin.deleteassignedcollege',[App\Http\Controllers\AdminController::class,'deleteassignedcollege'])->name('admin.deleteassignedcollege');
    Route::get('admin.addexam/{id}',[App\Http\Controllers\AdminController::class,'addexam'])->name('admin.addexam'); 
    Route::post('admin.saveexam',[App\Http\Controllers\AdminController::class,'saveexam'])->name('admin.saveexam');
    Route::post('admin.deletexam',[App\Http\Controllers\AdminController::class,'deleteexam'])->name('admin.deletexam');
    Route::get('admin.assigncourse/{id}',[App\Http\Controllers\AdminController::class,'assigncourse'])->name('admin.assigncourse'); 
    Route::post('admin.savejobcourse',[App\Http\Controllers\AdminController::class,'savejobcourse'])->name('admin.savejobcourse');
    Route::post('admin.deletejobcourse',[App\Http\Controllers\AdminController::class,'deletejobcourse'])->name('admin.deletejobcourse');
  
    Route::get('admin.viewstudent', [App\Http\Controllers\AdminController::class, 'viewstudent'])->name('admin.viewstudent');
    Route::get('admin.viewmorestudent/{id}',[App\Http\Controllers\AdminController::class,'getstudent'])->name('admin.viewmorestudent');
    Route::post('admin.viewstudent',[App\Http\Controllers\AdminController::class,'deletestudent'])->name('admin.deletestudent');
    Route::get('admin.viewcollege',[App\Http\Controllers\AdminController::class,'viewcollege'])->name('admin.viewcollege'); 
    Route::get('admin.viewmorecollege/{id}',[App\Http\Controllers\AdminController::class,'getcollege'])->name('admin.viewmorecollege');
    //Route::get('productdetail/{id}',[App\Http\Controllers\GuestController::class,'productdetail'])->name('productdetail');
    Route::post('admin.deletecollege',[App\Http\Controllers\AdminController::class,'deletecollege'])->name('admin.deletecollege');
    //updatecollegestatus
    Route::post('admin.updatecollegestatus',[App\Http\Controllers\AdminController::class,'updatecollegestatus'])->name('admin.updatecollegestatus');
    Route::post('admin.updatestudentstatus',[App\Http\Controllers\AdminController::class,'updatestudentstatus'])->name('admin.updatestudentstatus');
    Route::get('admin.addinstructor',[App\Http\Controllers\AdminController::class,'addinstructors'])->name('admin.addinstructor');
    Route::post('admin.addinstructor',[App\Http\Controllers\AdminController::class,'addinstructor'])->name('admin.addinstructor');
    Route::post('admin.addinstructors',[App\Http\Controllers\AdminController::class,'deleteinstructor'])->name('admin.deleteinstructor');
    //college 
    Route::get('college.editprofile',[App\Http\Controllers\CollegeController::class,'editprofile'])->name('college.editprofile');
    Route::post('college.updateprofile',[App\Http\Controllers\CollegeController::class,'updateprofile'])->name('college.updateprofile');
    Route::get('college.editcourses',[App\Http\Controllers\CollegeController::class,'editcourses'])->name('college.editcourses');
    Route::post('college.deletecourse',[App\Http\Controllers\CollegeController::class,'deletecourse'])->name('college.deletecourse');
    Route::post('college.addcourses', [App\Http\Controllers\CollegeController::class, 'addcourse'])->name('college.addcourses');
    Route::get('college.changepassword',[App\Http\Controllers\CollegeController::class,'changepassword'])->name('college.changepassword');
    Route::post('college.updatepassword',[App\Http\Controllers\CollegeController::class,'updatepassword'])->name('college.updatepassword');
    
});