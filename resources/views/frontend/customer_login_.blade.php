@extends('frontend.master')
@section('content')
<!-- ======================= Top Breadcrubms ======================== -->
<div class="gray py-3">
     <div class="container">
          <div class="row">
               <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                         <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item"><a href="#">Pages</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Login</li>
                         </ol>
                    </nav>
               </div>
          </div>
     </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Login Detail ======================== -->
<section class="middle">
     <div class="container">
          <div class="row align-items-start justify-content-between">
          
               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 m-auto">
                    @if (session('pass_reset_success'))
                         <div class="alert alert-success">{{session('pass_reset_success')}}</div>
                    @endif
                    <div class="mb-3">
                         <h3>Login</h3>
                    </div>
                    <form class="border p-3 rounded" action="{{route('customer.login')}}" method="POST">
                         @csrf				
                         <div class="form-group">
                              <label>Email *</label>
                              <input type="text" name="email" class="form-control" placeholder="Email*">
                              @error('email')
                                   <strong class="text-danger">{{$message}}</strong>
                              @enderror
                         </div>
                         
                         <div class="form-group">
                              <label>Password *</label>
                              <input type="password" class="form-control" name="password" placeholder="Password*">
                              @error('password')
                                   <strong class="text-danger">{{$message}}</strong>
                              @enderror
                         </div>
                         
                         <div class="form-group">
                              <div class="d-flex align-items-center justify-content-between">
                                   <div class="eltio_k2">
                                        <a href="{{route('password.reset.form')}}">Lost Your Password?</a>
                                   </div>	
                              </div>
                         </div>
                         
                         <div class="form-group">
                              <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Login</button>
                         </div>
                         <div class="mb-3 login">
                              <a href="{{url('/github/provider')}}" class="btn btn-md full-width bg-primary text-white fs-md ft-medium"><i class="fa-brands fa-github mr-3"></i>Continue With Github</a>
                          </div>
                          <div class="mb-3 mt-4 login">
                               <a href="{{url('/google/provider')}}" class="btn btn-md full-width bg-danger text-white fs-md ft-medium"><i class="fa-brands fa-google mr-3"></i>Continue With Google</a>
                         </div>
                         <div class="mb-3 mt-4 login">
                              <a href="" class="btn btn-md full-width bg-info text-white fs-md ft-medium"><i class="fa-brands fa-facebook-f mr-3"></i>Continue With Facebokk</a>
                         </div>
                          <div class="form-group">
                              <a href="{{route('customer.register')}}" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Create a new accountt?Go to Registration</a>
                         </div>
                    </form>
               </div>
          </div>
     </div>
</section>
<!-- ======================= Login End ======================== -->
@endsection