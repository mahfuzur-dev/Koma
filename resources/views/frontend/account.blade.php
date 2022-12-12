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
                              <li class="breadcrumb-item active" aria-current="page">My Order</li>
                         </ol>
                    </nav>
               </div>
          </div>
     </div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Dashboard Detail ======================== -->
<section class="middle">
     <div class="container">
          <div class="row align-items-start justify-content-between">
          
               <div class="col-12 col-md-12 col-lg-4 col-xl-4 text-center miliods">
                    <div class="d-block border rounded">
                         <div class="dashboard_author px-2 py-5">
                              <div class="dash_auth_thumb circle p-1 border d-inline-flex mx-auto mb-2">
                                  @if (Auth::guard('customerlogin')->user()->profile_photo == null)
                                        <img src="{{ Avatar::create(Auth::guard('customerlogin')->user()->name)->toBase64() }}" />
                                     @else
                                      <img style="width: 120px;height:120px;" src="{{asset('uploads/customer/profile')}}/{{Auth::guard('customerlogin')->user()->profile_photo}}" class="img-fluid circle" width="100" alt="" />
                                   @endif
                              </div>
                              <div class="dash_caption">
                                   <h4 class="fs-md ft-medium mb-0 lh-1">{{Auth::guard('customerlogin')->user()->name}}</h4>
                                   <span class="text-muted smalls">{{Auth::guard('customerlogin')->user()->email}}</span>
                              </div>
                         </div>
                         
                         <div class="dashboard_author">
                              <h4 class="px-3 py-2 mb-0 lh-2 gray fs-sm ft-medium text-muted text-uppercase text-left">Dashboard Navigation</h4>
                              <ul class="dahs_navbar">
                                  <li><a href="{{route('account')}}"  class="active"><i class="lni lni-shopping-basket mr-2"></i>My Order</a></li>
                                   <li><a href="{{route('wish.info')}}"><i class="lni lni-heart mr-2"></i>Wishlist</a></li>
                                   <li><a href="{{route('profile.info')}}"><i class="lni lni-user mr-2"></i>Profile Info</a></li>
                                   <li><a href="{{route('customer.logout')}}"><i class="lni lni-power-switch mr-2"></i>Log Out</a></li>
                              </ul>
                         </div>
                         
                    </div>
               </div>
               <div class="col-12 col-md-12 col-lg-8 col-xl-8">
                    <table class="table table-striped table-hover text-center">
                         <tr>
                              <th>Order No</th>
                              <th>Sub Total</th>
                              <th>Discount</th>
                              <th>Delivery Charge</th>
                              <th>Total</th>
                              <th>Order Status</th>
                              <th>Action</th>
                         </tr>
                         @foreach ($orders as $order)
                              <tr>
                                   <td>#{{$order->id}}</td>
                                   <td>{{$order->sub_total}}</td>
                                   <td>{{$order->discount}}</td>
                                   <td>{{$order->delivery}}</td>
                                   <td>{{$order->total}}</td>
                                   <td>
                                        @php
                                             if($order->status == 1){
                                                  echo '<span class="badge badge-info">Placed</span>';
                                             }
                                             elseif($order->status == 2){
                                                  echo '<span class="badge badge-warning">Processing</span>';
                                             }
                                             elseif($order->status == 3){
                                                  echo '<span class="badge badge-primary">Ready To Deliver</span>';
                                             }
                                             elseif($order->status == 4){
                                                  echo '<span class="badge badge-success">Delivery</span>';
                                             }
                                             elseif($order->status == 5){
                                                  echo '<span class="badge badge-danger">Cancel</span>';
                                             }
                                             else {
                                                  echo 'Unknown';
                                             }
                                        @endphp
                                   </td>
                                   <td>
                                        <a href="{{route('invoice.download',$order->id)}}" class="btn btn-success">Invoice</a>
                                   </td>
                              </tr>
                         @endforeach
                    </table>
               </div>
               
          </div>
     </div>
</section>
<!-- ======================= Dashboard Detail End ======================== -->
@endsection