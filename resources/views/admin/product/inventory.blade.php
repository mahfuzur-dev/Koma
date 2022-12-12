@extends('layouts.dashboard')
@section('content')
<div class="page-content">
     <nav class="page-breadcrumb">
          <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Product</a></li>
               <li class="breadcrumb-item active" aria-current="page">Product Inventory</li>
          </ol>
     </nav>
</div>
<div class="container">
     <div class="row">
          <div class="col-lg-8">
               <div class="card">
                    <div class="card-header bg-secondary mb-2">
                         <h4 class="text-white">Inventory List</h4>
                    </div>
                    @if (session('delete_inventory'))
                         <div class="alert alert-danger">{{session('delete_inventory')}}</div>
                    @endif
                    <div class="card-body">
                         <table class="table table-warning table-hover text-center">
                              <tr>
                                   <th>Sl No</th>
                                   <th>Product Name</th>
                                   <th>Color Name</th>
                                   <th>Size Name</th>
                                   <th>Quantity</th>
                                   <th>Action</th>
                              </tr>
                              @foreach ($inventories as $key=>$inventory)
                                   <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$inventory->rel_to_product->product_name}}</td>
                                        <td>{{$inventory->rel_to_color->color_name}}</td>
                                        <td>{{$inventory->rel_to_size->size_name}}</td>
                                        <td>{{$inventory->quantity}}</td>
                                        <td>
                                             <div class="dropdown">
                                                  <button style="border: none;outline:none;background:transparent;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fa-solid fa-ellipsis-vertical"></i>
                                                  </button>
                                                  <div class="dropdown-menu mt-2" aria-labelledby="dropdownMenuButton1">
                                                       <a class="dropdown-item text-black" href="{{route('delete.inventory',$inventory->id)}}"><i class="fa-regular fa-trash-can mr-2"></i>Delete</a>
                                                  </div>
                                             </div>
                                        </td>
                                   </tr>
                              @endforeach
                         </table>
                    </div>
               </div>
          </div>
          <div class="col-lg-4">
               <div class="card">
                    <div class="card-header bg-info mb-2">
                         <h5 class="text-white">Add Inventory</h5>
                    </div>
                    @if (session('inventory_success'))
                         <div class="alert alert-success">{{session('inventory_success')}}</div>
                    @endif
                    <div class="card-body">
                         <form action="{{route('add.inventory')}}" method="POST">
                              @csrf
                              <div class="mb-3">
                                   <label for="" class="form-label">Product Name</label>
                                   <input type="text" readonly name="product_name" value="{{$product_info->product_name}}" class="form-control">
                                   <input type="hidden" name="product_id" value="{{$product_info->id}}" class="form-control">
                              </div>
                              <div class="mb-3">
                                   <label for="" class="form-label">Color Name</label>
                                   <select name="color_id" id="" class="form-control">
                                        <option value="">--Select Color--</option>
                                        @foreach ($colors as $color)
                                             <option value="{{$color->id}}">{{$color->color_name}}</option>
                                        @endforeach
                                        @error('color_id')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </select>
                              </div>
                              <div class="mb-3">
                                   <label for="" class="form-label">Size Name</label>
                                   <select name="size_id" id="" class="form-control">
                                        <option value="">--Select Size--</option>
                                        @foreach ($sizes as $size)
                                             <option value="{{$size->id}}">{{$size->size_name}}</option>
                                        @endforeach
                                        @error('size_id')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </select>
                              </div>
                              <div class="mb-3">
                                   <label for="" class="form-label">Quantity</label>
                                   <input type="number" class="form-control" name="quantity">
                                   @error('quantity')
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