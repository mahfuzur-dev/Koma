@extends('layouts.dashboard')
@section('content')
<div class="page-content">
     <nav class="page-breadcrumb">
          <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Product</a></li>
               <li class="breadcrumb-item active" aria-current="page">View Product</li>
          </ol>
     </nav>
</div>
<div class="container">
     <div class="row">
          <div class="col-lg-12">
               <div class="card">
                    <div class="card-header bg-info mb-3">
                         <h3 class="text-white">Product List</h3>
                    </div>
                    @if (session('delete_product'))
                         <div class="alert alert-danger">
                              {{session('delete_product')}}
                         </div>
                    @endif
                    <div class="card-body">
                         <table class="table table-hover text-center">
                              <tr>
                                   <th>Sl No</th>
                                   <th>Category name</th>
                                   <th>Sub-Categoryname</th>
                                   <th>Product Name</th>
                                   <th>Price</th>
                                   <th>Brand</th>
                                   <th>Discount</th>
                                   <th>After Discount</th>
                                   <th>Action</th>
                              </tr>
                              @foreach ($all_products as $key=>$product)
                                   <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$product->rel_to_category->category_name}}</td>
                                        <td>{{$product->rel_to_subcategory->subcategory_name}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->product_price}}</td>
                                        <td>{{$product->product_brand}}</td>
                                        <td>{{$product->discount}}</td>
                                        <td>{{$product->after_discount}}</td>
                                        <td>  
                                             <div class="dropdown">
                                                  <button style="border: none;outline:none;background:transparent;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fa-solid fa-ellipsis-vertical"></i>
                                                  </button>
                                                  <div class="dropdown-menu mt-2" aria-labelledby="dropdownMenuButton1">
                                                       <a class="dropdown-item text-black" href="{{route('inventory',$product->id)}}"><i class="fa-solid fa-box-archive mr-2"></i>Inventory</a>
                                                       <a class="dropdown-item text-black" href="{{route('delete.product',$product->id)}}"><i class="fa-regular fa-trash-can mr-2"></i>Delete</a>
                                                  </div>
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