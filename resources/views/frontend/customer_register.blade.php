@extends('frontend.master')
@section('content')
<!-- ======================= Top Breadcrubms ======================== -->
<div class="gray py-3">
     <div class="container">
          <div class="row">
               <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                         <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('frontend')}}">Home</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Register</li>
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
                    @if (session('customer_register'))
                         <div class="alert alert-success">{{session('customer_register')}}</div>
                    @endif
                    @if (session('email_verify'))
                         <div class="alert alert-success">{{session('email_verify')}}</div>
                    @endif
                    <div class="mb-3">
                         <h3>Register</h3>
                    </div>
                    <form class="border p-3 rounded" action="{{route('customer.register')}}" method="POST">
                         @csrf
                         <div class="row">
                              <div class="form-group col-md-12">
                                   <label>Full Name *</label>
                                   <input type="text" class="form-control" name="name" placeholder="Full Name">
                                   @error('name')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                         </div>
                         
                         <div class="form-group">
                              <label>Email *</label>
                              <input type="text" class="form-control" name="email" placeholder="Email*">
                              @error('email')
                                   <strong class="text-danger">{{$message}}</strong>
                              @enderror
                         </div>
                         
                         <div class="row">
                              <div class="form-group col-md-12">
                                   <label>Password *</label>
                                   <input type="password" class="form-control" name="password" placeholder="Password*">
                                   @error('password')
                                   <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                         </div>
                         <div class="form-group">
                              <button type="submit" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Create An Account</button>
                         </div>
                         
                         <div class="form-group">
                              <a href="{{route('customer.login.view')}}" class="btn btn-md full-width bg-dark text-light fs-md ft-medium">Have you already an account?Go to Login</a>
                         </div>
                    </form>
               </div>
               
          </div>
     </div>
</section>
<!-- ======================= Login End ======================== -->
@endsection