
  
 @extends('layout.master')
@section('content')  
<section class="h-100 bg-white">
  <div class="container py-5 h-100" style="min-height: 500px;margin-top:10%;margin-left:25%">
  <div class="col-md-12 footer-newsletter">
            <h4>Enter Your Destination</h4>
		   <form action="{{route('viewpath')}}" method="post">
        @csrf
              <div class="row">
              <div class="col-md-6">
                
			<select class="form-control" required id="joid" name="jobid">
                      <option value="">Search</option>
                      @foreach($destinations as $destination)
                      <option value="{{$destination->id}}">{{$destination->name}}</option>
                      @endforeach
                     
                    </select>
              </div>
              <div class="col-md-2">
					<input class="btn btn-info" type="submit" value="Search">
              </div>
              </div>
            </form>
          </div>
</div>
</section>

  @endsection