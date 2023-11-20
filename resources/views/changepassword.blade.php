@extends('layout.master')
@section('content')
<section id="about" class="about">
      <div class="container" data-aos="fade-up">
        <div style="margin-top: 10%" class="row">
            <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
                   {{ session('status') }}
         </div>
@elseif(session('failed'))
        <div class="alert alert-danger" role="alert">
                   {{ session('failed') }}
         </div>
@endif
             <form method="POST" action="{{route('college.updatepassword')}}">
             @csrf
                 
                             <div class="card-body">
                             <label class="form-label" for="form3Example8">Current Password</label>
               <input type="password"  class="form-control form-control-lg @error('cpassword') is-invalid @enderror " id="cpassword" name="cpassword" required/>
               @error('cpassword')
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                   @enderror
               
               <label class="form-label" for="form3Example8">New Password</label>
               <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror " id="password" name="password" required/>
               @error('password')
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                   @enderror
               
                 <label class="form-label" for="form3Example8">Confirm Password</label>
               <input type="password" class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror " id="password_confirmation" name="password_confirmation" required />
               @error('password_confirmation')
                   <span class="invalid-feedback" role="alert">
                       <strong>{{ $message }}</strong>
                   </span>
                   @enderror
               <button style="margin-top: 15px;" type="submit" class="btn btn-success btn-lg ms-2">Change</button>
                 
                             </div>
                         </div>

        </div>
      </div>
      </div>
    </section><!-- End About Section -->
@endsection
