@extends('layout.master')
@section('content')
<section id="trainers" class="trainers">
      <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="row aos-init aos-animate" data-aos="zoom-in" data-aos-delay="100">
          
        @foreach($instructors as $instructor)
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="{{asset('photos/'.$instructor->photo)}}" class="img-fluid" alt="">
              <div class="member-content">
                <h4>{{$instructor->name}}</h4>
                <span>{{$instructor->qualification}}</span>
                <p>
                  {{$instructor->description}}
                </p>
                
              </div>
            </div>
          </div>
          @endforeach
         

        </div>

      </div>
    </section>
            @endsection