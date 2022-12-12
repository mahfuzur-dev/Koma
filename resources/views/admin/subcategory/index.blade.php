@extends('layouts.dashboard')
@section('content')
<div class="page-content">
     <nav class="page-breadcrumb">
          <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Sub-Category</a></li>
               <li class="breadcrumb-item active" aria-current="page">Sub-Category list</li>
          </ol>
     </nav>
</div>
<div class="container">
     <div class="row">
          <div class="col-lg-8">
               <div class="card">
                    <div class="card-header bg-info mb-2">
                         <h3 class="text-white">Sub-Category List</h3>
                    </div>
                    
                    @if (session('delete_subcategory'))
                         <div class="alert alert-danger">{{session('delete_subcategory')}}</div>
                    @endif
                    <div class="card-body">
                         <table class="table table-light table-hover text-center">
                              <tr>
                                   <th>Sl No</th>
                                   <th>Category Name</th>
                                   <th>Sub-Category Name</th>
                                   <th>Action</th>
                              </tr>
                              @foreach ($all_subcategories as $key=>$subcategory)
                                   <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$subcategory->rel_to_category->category_name}}</td>
                                        <td>{{$subcategory->subcategory_name}}</td>
                                        <td>
                                             <div class="dropdown">
                                                  <button style="border: none;outline:none;background:transparent;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fa-solid fa-ellipsis-vertical"></i>
                                                  </button>
                                                  <div class="dropdown-menu mt-2" aria-labelledby="dropdownMenuButton1">
                                                       <a class="dropdown-item text-black" href="{{route('delete.subcategory',$subcategory->id)}}"><i class="fa-regular fa-trash-can mr-2"></i>Delete</a>
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
                    <div class="card-header bg-success">
                         <h4 class="text-white">Add Category</h4>
                    </div>
                    @if (session('subcategory_success'))
                         <div class="alert alert-success">{{session('subcategory_success')}}</div>
                    @endif
                    @if (session('exist'))
                         <div class="alert alert-danger">{{session('exist')}}</div>
                    @endif
                    <div class="card-body">
                         <form action="{{route('add.subcategory')}}" method="POST">
                              @csrf
                              <div class="mb-3">
                                   <label for="" class="form-lable">Category Name</label>
                                   <select name="category_id" class="form-control">
                                        <option value="">--Select Category--</option>
                                        @foreach ($all_categories as $category)
                                             <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                   </select>
                                   @error('category_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <label for="" class="form-lable">Sub-Category Name</label>
                                   <input type="text" class="form-control" name="subcategory_name">
                              </div>
                              <div class="mb-3">
                                   <button type="submit" class="btn btn-info">Submit</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection