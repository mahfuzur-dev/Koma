@extends('frontend.master')
@section('content')
<div class="gray py-3">
     <div class="container">
          <div class="row">
               <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                         <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('frontend')}}">Home</a></li>
                              <li class="breadcrumb-item"><a href="#">Password</a></li>
                         </ol>
                    </nav>
               </div>
          </div>
     </div>
</div>
<div class="container my-5">
     <div class="row">
          <div class="col-lg-8 col-md-8 m-auto">
               <div class="card">
                    <div class="card-header bg-danger mb-3">
                         <h3 class="text-white">Password Form</h3>
                    </div>
                    <div class="card-body">
                         <form action="{{route('pass.new.send')}}" method="POST">
                              @csrf
                              <div class="mb-3">
                                   <label for="" class="form-label">New Password</label>
                                   <input type="password" class="form-control" name="password" placeholder="Enter Your New Password">
                                   <input type="hidden" class="form-control" name="reset_token" value="{{$data}}">
                              </div>
                              <div class="mb-3">
                                   <button type="submit" class="btn btn-success">Submit</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection