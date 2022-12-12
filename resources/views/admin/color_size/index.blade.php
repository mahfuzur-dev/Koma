@extends('layouts.dashboard')
@section('content')
<div class="page-content">
     <nav class="page-breadcrumb">
          <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Color & Size</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Color & Size</li>
          </ol>
     </nav>
</div>
<div class="row">
     <div class="col-lg-8">
          <div class="row">
               <div class="col-lg-12">
                    <div class="card">
                         <div class="card-header bg-info mb-3">
                              <h5 class="text-white">Color List</h5>
                         </div>
                          @if (session('color_del'))
                              <div class="alert alert-danger">{{session('color_del')}}</div>
                         @endif
                         <div class="card-body">
                              <table class="table table-secondary table-hover text-center">
                                   <tr>
                                        <th>Sl No</th>
                                        <th>Color Name</th>
                                        <th>Color Code</th>
                                        <th>Color</th>
                                        <th>Action</th>
                                   </tr>
                                   @foreach ($all_colors as $key=>$color)
                                        <tr>
                                             <td>{{$key+1}}</td>
                                             <td>{{$color->color_name}}</td>
                                             <td>{{$color->color_code}}</td>
                                             <td><button style="border: none;ouline:none; padding:12px; background:{{$color->color_code}}"></button></td>
                                             <td>
                                                  <div class="dropdown">
                                                       <button style="border: none;outline:none;background:transparent;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                       <i class="fa-solid fa-ellipsis-vertical"></i>
                                                       </button>
                                                       <div class="dropdown-menu mt-2" aria-labelledby="dropdownMenuButton1">
                                                            
                                                            <a class="dropdown-item text-black" href="{{route('delete.color',$color->id)}}"><i class="fa-regular fa-trash-can mr-2"></i>Delete</a>
                                                       </div>
                                                   </div>
                                             </td>
                                        </tr>
                                   @endforeach
                              </table>
                         </div>
                    </div>
               </div>
               <div class="col-lg-12 mt-5">
                    <div class="card">
                         <div class="card-header bg-info mb-3">
                              <h5 class="text-white">Size List</h5>
                         </div>
                          @if (session('size_del'))
                              <div class="alert alert-danger">{{session('size_del')}}</div>
                         @endif
                         <div class="card-body">
                              <table class="table table-secondary table-hover text-center">
                                   <tr>
                                        <th>Sl No</th>
                                        <th>Size Name</th>
                                        <th>Action</th>
                                   </tr>
                                   @foreach ($all_sizes as $key=>$size)
                                        <tr>
                                             <td>{{$key+1}}</td>
                                             <td>{{$size->size_name}}</td>
                                             <td>
                                                  <div class="dropdown">
                                                       <button style="border: none;outline:none;background:transparent;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                       <i class="fa-solid fa-ellipsis-vertical"></i>
                                                       </button>
                                                       <div class="dropdown-menu mt-2" aria-labelledby="dropdownMenuButton1">
                                                            
                                                            <a class="dropdown-item text-black" href="{{route('delete.size',$size->id)}}"><i class="fa-regular fa-trash-can mr-2"></i>Delete</a>
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
     <div class="col-lg-4">
          <div class="row">
               <div class="col-lg-12">
                    <div class="card">
                         <div class="card-header bg-info mb-3">
                              <h5 class="text-white">Add Color</h5>
                         </div>
                         @if (session('color_success'))
                              <div class="alert alert-success">{{session('color_success')}}</div>
                         @endif
                         <div class="card-body">
                              <form action="{{route('add.color')}}" method="POST">
                                   @csrf
                                   <div class="mb-3">
                                        <label for="" class="form-label">Color Name</label>
                                        <input type="text" name="color_name" class="form-control">
                                        @error('color_name')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </div>
                                   <div class="mb-3">
                                        <label for="" class="form-label">Color Code</label>
                                        <input type="text" name="color_code" class="form-control" placeholder="#a2d1c2">
                                        @error('color_code')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </div>
                                   <div class="mb-3">
                                        <button type="sumbit" class="btn btn-success">Submit</button>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
               <div class="col-lg-12 mt-4">
                    <div class="card">
                         <div class="card-header bg-info mb-3">
                              <h5 class="text-white">Add Size</h5>
                         </div>
                         @if (session('size_success'))
                              <div class="alert alert-success">{{session('size_success')}}</div>
                         @endif
                         <div class="card-body">
                              <form action="{{route('add.size')}}" method="POST">
                                   @csrf
                                   <div class="mb-3">
                                        <label for="" class="form-label">Size Name</label>
                                        <input type="text" name="size_name" class="form-control">
                                        @error('size_name')
                                             <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                   </div>
                                   <div class="mb-3">
                                        <button type="sumbit" class="btn btn-success">Submit</button>
                                   </div>
                              </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
@endsection