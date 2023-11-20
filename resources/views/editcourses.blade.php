@extends('layout.master')
@section('content')
<section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-8 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                       {{ session('status') }}
             </div>
    @elseif(session('failed'))
            <div class="alert alert-danger" role="alert">
                       {{ session('failed') }}
             </div>
    @endif
            <table style="margin-top: 10%" class="table">
                <tr>
                <th>SI</th>
                <th>Name of Course </th>
                <th>Action</th>
                </tr>
                @php $i=1; @endphp
                @foreach($courses as $course)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$course->course_title}}</td>
                    <td>
                        <form action="{{'college.deletecourse'}}" method="post">
                            @csrf
                            <input type="hidden" id="pdelete" name="pdelete" value="{{$course->id}}"/>
                            <input type="submit" class="btn btn-sm btn-danger" value="Delete" />
                        </form>
                    </td>
                </tr>
                @php $i++; @endphp
                @endforeach
            </table>
          </div>
          <div class="col-lg-4 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3 style="margin-top:40px">Add Your Courses</h3>
            <form class="px-md-2" method="POST" action="{{route('college.addcourses')}}">
                @csrf
            <div class="row">
                <input type="hidden" id="cid" name="cid" />
            <div class="form-outline mb-4">
                <label class="form-label">Select Course</label>
                <select class="form-control  @error('course_id') is-invalid @enderror "" id="course_id" name="course_id" required>
                    <option value="">Select</option>
                    @foreach($acourses as $ac)
                    <option value="{{$ac->id}}">{{$ac->course_title}}</option>
                    @endforeach
                </select>
                @error('course_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
               
            </div>
           
            
            </div>
            <input class="btn btn-primary" type="submit" value="Save"/>
            </form>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->
@endsection
