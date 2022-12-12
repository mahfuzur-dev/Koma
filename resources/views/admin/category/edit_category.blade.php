@extends('layouts.dashboard')
@section('content')
<div class="page-content">
     <nav class="page-breadcrumb">
          <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Category</a></li>
               <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
          </ol>
     </nav>
</div>
<div class="container">
     <div class="row">
          <div class="col-lg-8 m-auto">
               <div class="card">
                    <div class="card-header bg-success">
                         <h4 class="text-white">Edit Category</h4>
                    </div>
                    <div class="card-body">
                         <form action="{{route('update.category')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="mb-3">
                                   <label for="" class="form-lable">Category Name</label>
                                   <input type="text" class="form-control" name="category_name" value="{{$category_info->category_name}}">
                                   <input type="hidden" class="form-control" name="category_id" value="{{$category_info->id}}">
                              </div>
                              <div class="mb-3">
                                   <label for="" class="form-lable">Category Image</label>
                                   <input type="file" class="form-control" name="category_image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                   <img src="{{asset('uploads/category')}}/{{$category_info->category_image}}" style="width: 100px;height:100px;" id="blah" alt="">
                              </div>
                              <div class="mb-3">
                                   <button type="submit" class="btn btn-info">Update</button>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection