@extends('layouts.dashboard')
@section('content')
<div class="row mt-5 pt-5">
     <div class="col-lg-5">
          <div class="card mt-2">
               @if (session('name_success'))
                   
               @endif
               <div class="card-body">
                    <form action="{{route('update.name')}}" method="POST">
                         @csrf
                         <div class="mb-3">
                              <label for="" class="form-label">User Name</label>
                              <input type="text" name="name" value="{{Auth::user()->name}}" class="form-control">
                         </div>
                         <div class="mb-3">
                              <button type="submit" class="btn btn-info">Update Name</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
     <div class="col-lg-5 mt-2">
          <div class="card">
               @if (session('name_success'))
                   
               @endif
               <div class="card-body">
                    <form action="{{route('add.photo')}}" method="POST" enctype="multipart/form-data">
                         @csrf
                         <div class="mb-3">
                              <label for="" class="form-label">Profile Photo</label>
                              <input type="file" name="profile_photo" class="form-control">
                         </div>
                         <div class="mb-3">
                              <button type="submit" class="btn btn-info">Submit</button>
                         </div>
                    </form>
               </div>
          </div>
     </div>
     <div class="col-lg-5 mt-4">
          <div class="card">
                @if (session('pass_success'))
                   
               @endif
               <div class="card-header">
                    <h4>Change Password</h4>
               </div>
               <div class="card-body">
                  <form action="{{route('update.password')}}" method="POST">
                    @csrf
                         <div class="mb-3">
                              <label for="" class="form-label">Old Password</label>
                              <input type="password" name="old_password" class="form-control">
                              @error('old_password')
                                  <strong class="text-danger">{{$message}}</strong>
                              @enderror
                         </div>
                         <div class="mb-3">
                              <label for="" class="form-label">New Password</label>
                              <input type="password" name="password" class="form-control">
                              @error('password')
                                  <strong class="text-danger">{{$message}}</strong>
                              @enderror
                         </div>
                         <div class="mb-3">
                              <label for="" class="form-label">Confirm Password</label>
                              <input type="password" name="password_confirmation" class="form-control">
                              @error('password_confirmation')
                                   <strong class="text-danger">{{$message}}</strong>
                              @enderror
                         </div>
                         <div class="mb-3">
                              <button type="submit" class="btn btn-info">Update Password</button>
                         </div>
                  </form>
               </div>
          </div>
     </div>
</div>

@endsection
@section('footer_script')
  @if (session('name_success'))
       <script>
     swal({
          title: "Good job!",
          text: "{{session('name_success')}}",
          type: "success",
          confirmButtonText: "Ok"
     });
</script>
  @endif
  @if (session('pass_success'))
       <script>
     swal({
          title: "Good job!",
          text: "{{session('pass_success')}}",
          type: "success",
          confirmButtonText: "Ok"
     });
</script>
  @endif
@endsection