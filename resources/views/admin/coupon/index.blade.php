@extends('layouts.dashboard')
@section('content')
<div class="page-content">
     <nav class="page-breadcrumb">
          <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
               <li class="breadcrumb-item active" aria-current="page">Coupon</li>
          </ol>
     </nav>
</div>
<div class="container">
     <div class="row">
          <div class="col-lg-7">
               <div class="card">
                         <div class="card-header bg-info mb-3">
                              <h5 class="text-white">Coupon List</h5>
                         </div>
                          @if (session('coupon_del'))
                              <div class="alert alert-danger">{{session('coupon_del')}}</div>
                         @endif
                         <div class="card-body">
                              <table class="table table-secondary table-hover text-center">
                                   <tr>
                                        <th>Sl No</th>
                                        <th>Coupon Name</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Validity</th>
                                        <th>Action</th>
                                   </tr>
                                   @foreach ($all_coupons as $key=>$coupon)
                                        <tr>
                                             <td>{{$key+1}}</td>
                                             <td>{{$coupon->coupon_name}}</td>
                                             <td>{{$coupon->type}}</td>
                                             <td>{{$coupon->amount}}</td>
                                             <td>{{$coupon->validity}}</td>
                                             <td>
                                                  <div class="dropdown">
                                                       <button style="border: none;outline:none;background:transparent;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                       <i class="fa-solid fa-ellipsis-vertical"></i>
                                                       </button>
                                                       <div class="dropdown-menu mt-2" aria-labelledby="dropdownMenuButton1">
                                                            
                                                            <a class="dropdown-item text-black" href="{{route('delete.coupon',$coupon->id)}}"><i class="fa-regular fa-trash-can mr-2"></i>Delete</a>
                                                       </div>
                                                   </div>
                                             </td>
                                        </tr>
                                   @endforeach
                              </table>
                         </div>
                    </div>
          </div>
          <div class="col-lg-5">
               <div class="card">
                    <div class="card-header bg-info mb-3">
                         <h3 class="text-white">Add Coupon</h3>
                    </div>
                    @if (session('coupon_success'))
                         <div class="alert alert-success">{{session('coupon_success')}}</div>
                    @endif
                    <div class="card-body">
                         <form action="{{route('add.coupon')}}" method="POST">
                              @csrf
                              <div class="mb-3">
                                   <label for="" class="form-label">Coupon Name</label>
                                   <input type="text" name="coupon_name" class="form-control">
                                   @error('coupon_name')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <label for="" class="form-label">Coupon Type</label>
                                   <select name="type" id="" class="form-control">
                                        <option value="">---Select Coupon---</option>
                                        <option value="1">Solid Amount</option>
                                        <option value="2">Percentage</option>
                                   </select>
                                    @error('type')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <label for="" class="form-label">Amount</label>
                                   <input type="number" name="amount" class="form-control">
                                    @error('amount')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <label for="" class="form-label">Validity</label>
                                   <input type="date" name="validity" class="form-control">
                                    @error('validity')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
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