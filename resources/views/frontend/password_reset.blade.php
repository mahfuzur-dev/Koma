@extends('frontend.master')
@section('content')
<div class="gray py-3">
     <div class="container">
          <div class="row">
               <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                         <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('frontend')}}">Home</a></li>
                              <li class="breadcrumb-item"><a href="#">Password Reset</a></li>
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
                         <h3 class="text-white">Password Reset</h3>
                    </div>
                    @if (session('pass_reset'))
                         <div class="alert alert-danger">{{session('pass_reset')}}</div>
                    @endif
                    <div class="card-body">
                         <form action="{{route('pass.reset.send')}}" method="POST">
                              @csrf
                              <div class="mb-3">
                                   <label for="" class="form-label">Email</label>
                                   <input type="email" class="form-control" name="email" placeholder="Enter Your Email">
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