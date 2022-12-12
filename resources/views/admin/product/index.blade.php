@extends('layouts.dashboard')
@section('content')
<div class="page-content">
     <nav class="page-breadcrumb">
          <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="#">Product</a></li>
               <li class="breadcrumb-item active" aria-current="page">Add Product</li>
          </ol>
     </nav>
</div>
<div class="container">
     <div class="row">
         <div class="col-lg-12">
               <div class="card">
                    <div class="card-header bg-info text-center mb-2">
                         <h3 class="text-white">Add Product</h3>
                    </div>
                    @if (session('product_success'))
                         <div class="alert alert-success">{{session('product_success')}}</div>
                    @endif
                    <div class="card-body">
                         <form action="{{route('add.product')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="" class="form-label">Category Name</label>
                                             <select name="category_id" id="category" class="form-control">
                                                  <option value="">--Select Categroy--</option>
                                                  @foreach ($all_categories as $category)
                                                       <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                  @endforeach
                                             </select>
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="" class="form-label">SubCategory Name</label>
                                             <select name="subcategory_id" id="subcategory" class="form-control">
                                                  <option value="">--Select Categroy--</option>
                                                  @foreach ($all_subcategories as $subcategory)
                                                       <option value="{{$subcategory->id}}">{{$subcategory->subcategory_name}}</option>
                                                  @endforeach
                                             </select>
                                        </div>
                                   </div>
                                   <div class="col-lg-4">
                                        <div class="mb-3">
                                             <label for="" class="form-label">Product Name</label>
                                             <input type="text" name="product_name" class="form-control">
                                             @error('product_name')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-lg-4">
                                        <div class="mb-3">
                                             <label for="" class="form-label">Product Price</label>
                                             <input type="number" name="product_price" class="form-control">
                                             @error('product_price')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-lg-4">
                                        <div class="mb-3">
                                             <label for="" class="form-label">Product Brand</label>
                                             <input type="text" name="product_brand" class="form-control">
                                        </div>
                                   </div>
                                   <div class="col-lg-4">
                                        <div class="mb-3">
                                             <label for="" class="form-label">Discount</label>
                                             <input type="number" name="discount" class="form-control">
                                        </div>
                                   </div>
                                   <div class="col-lg-8">
                                        <div class="mb-3">
                                             <label for="" class="form-label">Short Description</label>
                                             <input type="text" name="short_desp" class="form-control">
                                             @error('short_desp')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-lg-12">
                                        <div class="mb-3">
                                             <label for="" class="form-label">Long Description</label>
                                             <textarea type="text" id="summernote" name="long_desp" class="form-control"></textarea>
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="" class="form-label">Preview</label>
                                             <input type="file" name="preview" class="form-control">
                                             @error('preview')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                   </div>
                                   <div class="col-lg-6">
                                        <div class="mb-3">
                                             <label for="" class="form-label">Thumbnail</label>
                                             <input type="file" multiple name="thumbnail[]" class="form-control">
                                        </div>
                                   </div>
                                   <div class="col-lg-6 m-auto">
                                        <div class="mb-4 text-center">
                                             <button type="submit" class="btn btn-info">Submit</button>
                                        </div>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
         </div>
     </div>
</div>
@endsection
@section('footer_script')
<script>
     $('#category').change(function(){
          var category_id = $(this).val();

           $.ajaxSetup({
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
          });
          $.ajax({
               type:'POST',
               url:'/getsubcategory',
               data:{'category_id':category_id},
               success:function(data){
                    $('#subcategory').html(data);
               }
          });
     });
    
</script>
<script>
     $(document).ready(function() {
           $('#summernote').summernote();
     });
</script>
@endsection