@extends('layouts.dashboard')
@section('content')
<div class="page-content">
     <nav class="page-breadcrumb">
          <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Category</a></li>
               <li class="breadcrumb-item active" aria-current="page">Category list</li>
          </ol>
     </nav>
</div>
<div class="container">
     <div class="row">
          <div class="col-lg-8">
               <div class="card">
                    <div class="card-header bg-dark">
                         <h3 class="text-white">Category List</h3>
                    </div>
                     @if (session('category_update'))
                         <div class="alert alert-success">{{session('category_update')}}</div>
                    @endif
                     @if (session('delete_category'))
                         <div class="alert alert-danger">{{session('delete_category')}}</div>
                    @endif
                    <div class="card-body">
                         <table class="table table-info table-hover text-center">
                              <tr>
                                   <th>Sl No</th>
                                   <th>Category Name</th>
                                   <th>Category Image</th>
                                   <th>Added By</th>
                                   <th>Action</th>
                              </tr>
                              @foreach ($all_categories as $key=>$category)
                                   <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$category->category_name}}</td>
                                        <td>
                                             <img style="width: 30px;height:20px; border-radius:0;" src="{{asset('uploads/category')}}/{{$category->category_image}}" alt="">
                                        </td>
                                        <td>{{$category->added_by}}</td>
                                        <td>
                                             <div class="dropdown">
                                                  <button style="border: none;outline:none;background:transparent;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                  <i class="fa-solid fa-ellipsis-vertical"></i>
                                                  </button>
                                                  <div class="dropdown-menu mt-2" aria-labelledby="dropdownMenuButton1">
                                                       <a class="dropdown-item text-black" href="{{route('edit.category',$category->id)}}"><i class="fa-regular fa-edit mr-2"></i>Edit</a>
                                                       <a class="dropdown-item text-black" href="{{route('delete.category',$category->id)}}"><i class="fa-regular fa-trash-can mr-2"></i>Delete</a>
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
                    @if (session('category_success'))
                         <div class="alert alert-success">{{session('category_success')}}</div>
                    @endif
                    <div class="card-body">
                         <form action="{{route('add.category')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="mb-3">
                                   <label for="" class="form-lable">Category Name</label>
                                   <input type="text" class="form-control" name="category_name">
                                   @error('category_name')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                              <div class="mb-3">
                                   <label for="" class="form-lable">Category Image</label>
                                   <input type="file" class="form-control" name="category_image">
                                   @error('category_name')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
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