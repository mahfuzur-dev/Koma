@extends('layouts.dashboard')
@section('content')
<div class="row mt-5 pt-3">
     <div class="col-lg-10 m-auto">
          <div class="card mt-2">
               <div class="card-header bg-primary">
                    <h3 class="text-white text-center">User List</h3>
               </div>
               <div class="card-body">
                    <table class="table table-stripe table-info table-hover text-center">
                         <tr>
                              <th>Sl No</th>
                              <th>User Name</th>
                              <th>User Email</th>
                              <th>Action</th>
                         </tr>
                         @foreach ($users as $key=>$user)
                              <tr>
                                   <td>{{$key+1}}</td>
                                   <td>{{$user->name}}</td>
                                   <td>{{$user->email}}</td>
                                   <td>
                                        <div class="dropdown">
                                             <button style="border: none;outline:none;background:transparent;" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                 <i class="fa-solid fa-ellipsis-vertical"></i>
                                             </button>
                                             <div class="dropdown-menu mt-2" aria-labelledby="dropdownMenuButton1">
                                                  <a class="dropdown-item text-black" href="{{route('delete.user',$user->id)}}"><i class="fa-regular fa-trash-can mr-2"></i>Delete</a>
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
@endsection