
  
 @extends('layout.master')
 @section('content') 
 <div class="breadcrumbs" data-aos="fade-in">
    <div class="container">
      <h2>Engineer</h2>
      </div>
  </div><!-- End Breadcrumbs --> 
 <section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-3 col-md-6">
          <div class="box">
            <h3>Qualifications</h3>
            <ul>
              @foreach($courses as $course)
              
              <li><a href="{{route('viewmorepath',$course->course_id)}}">{{$course->course_title}}</a></li>
              
             @endforeach
            </ul>
            <div class="btn-wrap">
             
            </div>
          </div>
        </div>
        @if(isset($exams))
        <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
          <div class="box">
            <h3>Entrance Exams</h3>
            @if(count($exams)<=0)
            No Entrance Examination Found
            @endif
            <ul>
              @foreach($exams as $exam)
              <li>{{$exam->ename}}</li>
             @endforeach
            </ul>
            <div class="btn-wrap">
             
            </div>
          </div>
        </div>
        @endif
        @if(isset($colleges))
        <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
          <div class="box">
            <h3>Colleges & University</h3>
            
            <ul>
              @foreach($colleges as $college)
              <li>{{$college->name.'-'.$college->university}}</li>
             @endforeach
            </ul>
            <div class="btn-wrap">
            
            </div>
          </div>
        </div>
        @endif
      

      </div>

    </div>
  </section><!-- End Pricing Section -->

 
   @endsection