@extends('layout/adminmaster')
@section('content')
<main class="content">
<div class="container-fluid p-0"> 


<div class="col-xl-6 col-xxl-7">
<div class="card flex-fill">


             

                
</div>
</div>




                <div class="row">
						
						<div class="col-12 col-lg-6">
							

							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Add College</h5>
								</div>
                <form method="POST" action="{{route('admin.savecollege')}}">
                    
                      @csrf
                    @if (session('status'))
   		<div class="alert alert-success" role="alert">
  					{{ session('status') }}
			</div>
   @elseif(session('failed'))
       	<div class="alert alert-danger" role="alert">
  					{{ session('failed') }}
			</div>
   @endif
         
                
							  <div class="card-body">
                                <label class="form-label" for="form3Example8">College</label>
                 <select class="form-control" id="college" name="college" required>
                   <option value="">select</option>
                   @foreach($acolleges as $c)
                   <option value="{{$c->id}}">{{$c->name}}</option>
                   @endforeach
                 </select>
                                @error('college')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    <input type="hidden" id="courseid" name="courseid" value="{{$courseid}}"/>
                   
                  <button style="margin-top: 15px;" type="submit" class="btn btn-success btn-lg ms-2">save</button>
                  </div>
                </form>
								
							</div>

						</div>
					</div>




                    <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">View Colleges</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-hover">
                  <thead>
                  <tr>
                    <th>SI No</th>
                    <th>College</th>
                    <th>University</th>-->
                    <th>State</th>
                    <th>District</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php
                    $i=1;
                    @endphp
                  @foreach($colleges as  $college)

                 
                  <tr>
                    <td>{{$i}}</td>
                    <td>{{$college->name}}</td>
                  
                    <td>{{$college->university}}</td>
                 
                  <td>{{$college->state}}</td>
                  <td>{{$college->district}}</td>
                    <td>
                      <button title="Delete College" class="btn btn-danger btn-sm deleteme" data-value="{{$college->id}}"  data-toggle="modal" data-target="#modal-danger"><i class="fa fa-trash"></i></button>
                      
                      
                      </td>
                  </tr>
                  @php $i++;
                  @endphp
                  @endforeach
                  
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>SI No</th>
                    <th>College</th>
                    <th>University</th>-->
                    <th>State</th>
                    <th>District</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>

            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

        <!-- /.row -->

                </div>
                <div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Delete Course</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <form method="POST" action="{{route('admin.deleteassignedcollege')}}">
          @csrf
        <div class="modal-body">
          <p>Do you want to delete the course?</p>
          <input type="hidden" name="dodelete" id="dodelete"/>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
          <button type="submit" id="pdelete" name="pdelete" class="btn btn-danger">Yes</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
          
          
</main>
                @endsection