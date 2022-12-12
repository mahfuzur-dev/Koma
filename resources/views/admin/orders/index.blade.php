@extends('layouts.dashboard')
@section('content')
<div class="page-content">
     <nav class="page-breadcrumb">
          <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
               <li class="breadcrumb-item active" aria-current="page">Orders</li>
          </ol>
     </nav>
</div>
<div class="container">
     <div class="row">
          <div class="col-lg-12">
               <div class="card">
                    <div class="card-header bg-info">
                         <h3 class="text-white">Order List</h3>
                    </div>
                    <div class="card-body">
                         <table class="table table-striped table-light table-hover text-center">
                              <tr>
                                   <th>Sl No</th>
                                   <th>Order Id</th>
                                   <th>Sub Total</th>
                                   <th>Discount</th>
                                   <th>Charge</th>
                                   <th>Total</th>
                                   <th>Status</th>
                                   <th>Action</th>
                              </tr>
                              @foreach ($orders as $key=>$order)
                                   <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$order->id}}</td>
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
                                             <div class="dropdown">
                                                  <form action="{{route('order.status')}}" method="POST">
                                                       @csrf
                                                       <button style="border: none;outline:none;background:transparent;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                       <i class="fa-solid fa-ellipsis-vertical"></i>
                                                       </button>
                                                       <div class="dropdown-menu mt-2">
                                                            <button class="dropdown-item status" name="status" value="{{$order->id.','.'1'}}">Placed</button>
                                                            <button class="dropdown-item status" name="status" value="{{$order->id.','.'2'}}">Processing</button>
                                                            <button class="dropdown-item status" name="status" value="{{$order->id.','.'3'}}">Ready To Deliver</button>
                                                            <button class="dropdown-item status" name="status" value="{{$order->id.','.'4'}}">Delivery</button>
                                                            <button class="dropdown-item status" name="status" value="{{$order->id.','.'5'}}">Cancel</button>
                                                       </div>
                                                  
                                                  </form>
                                             </div>
                                        </td>
                                   </tr>
                              @endforeach
                         </table>
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection