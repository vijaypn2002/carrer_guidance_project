@extends('layout.master')
@section('content')

<section id="about" class="about">
    <style>
        .form-control{display:block;width:100%;padding:.375rem .75rem;font-size:1rem;font-weight:400;line-height:1.6;color:#4f4f4f;background-color:#fff;background-clip:padding-box;border:1px solid #bdbdbd;-webkit-appearance:none;-moz-appearance:none;appearance:none;border-radius:.25rem;box-shadow:inset 0 1px 2px rgba(0,0,0,.075);transition:all .2s linear}
    </style>
      <div class="container" data-aos="fade-up">

        <div class="row">
          <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
            <h3 style="margin-top:40px">Edit Profile</h3>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                       {{ session('status') }}
             </div>
    @elseif(session('failed'))
            <div class="alert alert-danger" role="alert">
                       {{ session('failed') }}
             </div>
    @endif
            <form class="px-md-2" method="POST" action="{{route('college.updateprofile')}}">
                @csrf
            <div class="row">
                <input type="hidden" id="cid" name="cid" value="{{$pdata->id}}"/>
            <div class="form-outline mb-4">
                <label class="form-label">Name</label>
                <input style="margin-left: 10%" type="text" value="{{$pdata->name}}" name="cname" id="cname" class="form-cntrol" required />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label">University</label>
                <input style="margin-left: 5%" type="text" value="{{$pdata->university}}" name="university" id="university" class="form-cntrol" required />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label">State</label>
                <input style="margin-left: 11%" type="text" value="{{$pdata->state}}"" name="state" id="state" class="form-cntrol" required />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label">District</label>
                <input style="margin-left: 8%" type="text" value="{{$pdata->district}}" name="district" id="district" class="form-cntrol" required />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label">Contact No</label>
                <input style="margin-left: 3%" type="text" value="{{$pdata->contact_no}}" name="cno" id="cno" class="form-cntrol" required />
            </div>
            <div class="form-outline mb-4">
                <label class="form-label">Address</label>
                <textarea style="margin-left: 6%" name="address" id="address" class="form-cntrol" required >{{$pdata->address}}</textarea>
            </div>
            <div class="form-outline mb-4">
                <label class="form-label">Email</label>
                <input style="margin-left: 10%" type="email" disabled value="{{$pdata->email}}" name="email" id="email" class="form-cntrol" required />
            </div>
            </div>
            <input class="btn btn-primary" type="submit" name="save" value="Update"/>
            </form>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->
@endsection
