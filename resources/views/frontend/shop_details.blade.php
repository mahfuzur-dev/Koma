@extends('frontend.master')
@section('content')
<!-- ======================= Shop Style 1 ======================== -->
<section class="bg-cover" style="background:url({{asset('frontend/img/banner-2.png')}}) no-repeat;">
     <div class="container">
          <div class="row align-items-center justify-content-center">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="text-left py-5 mt-3 mb-3">
                         <h1 class="ft-medium mb-3">Shop</h1>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- ======================= Shop Style 1 ======================== -->


<!-- ======================= Filter Wrap Style 1 ======================== -->
<section class="py-3 br-bottom br-top">
     <div class="container">
          <div class="row align-items-center justify-content-between">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <nav aria-label="breadcrumb">
                         <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('frontend')}}">Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('shop.details')}}">Shop</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Women's</li>
                         </ol>
                    </nav>
               </div>
          </div>
     </div>
</section>
<!-- ============================= Filter Wrap ============================== -->


<!-- ======================= All Product List ======================== -->
<section class="middle">
     <div class="container">
          <div class="row">
               
               <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 p-xl-0">
                    <div class="search-sidebar sm-sidebar border">
                         <div class="search-sidebar-body">
                              <!-- Single Option -->
                              <div class="single_search_boxed">
                                   <div class="widget-boxed-header">
                                        <h4><a href="#pricing" data-toggle="collapse" aria-expanded="false" role="button">Pricing</a></h4>
                                   </div>
                                   <div class="widget-boxed-body collapse show" id="pricing" data-parent="#pricing">
                                        <div class="row">
                                             <div class="col-lg-6 pr-1">
                                                  <div class="form-group pl-3">
                                                       <input type="number" id="min" name="min" value="{{@$_GET['min']}}" class="form-control" placeholder="Min">
                                                  </div>
                                             </div>
                                             <div class="col-lg-6 pl-1">
                                                  <div class="form-group pr-3">
                                                       <input type="number" id="max" name="max" value="{{@$_GET['max']}}" class="form-control" placeholder="Max">
                                                  </div>
                                             </div>
                                             <div class="col-lg-12">
                                                  <div class="form-group px-3">
                                                       <button type="submit" id="range" class="btn form-control">Submit</button>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <!-- Single Option -->
                              <div class="single_search_boxed">
                                   <div class="widget-boxed-header">
                                        <h4><a href="#Categories" data-toggle="collapse" aria-expanded="false" role="button">Categories</a></h4>
                                   </div>
                                   <div class="widget-boxed-body collapse show" id="Categories" data-parent="#Categories">
                                        <div class="side-list no-border">
                                             <!-- Single Filter Card -->
                                             <div class="single_filter_card">
                                                  <div class="card-body pt-0">
                                                       <div class="inner_widget_link">
                                                            <ul class="no-ul-list">
                                                                 @foreach ($all_categories as $category)
                                                                      
                                                                 <li>
                                                                      <input id="category1{{$category->id}}" class="category_id" name="category_id" value="{{$category->id}}" type="radio" @if (isset($_GET['category_id']))
                                                                           @if ($_GET['category_id'] == $category->id)
                                                                                checked 
                                                                           @endif
                                                                      @endif>
                                                                      <label for="category1{{$category->id}}" class="checkbox-custom-label">{{$category->category_name}}</label>
                                                                 </li>
                                                                 @endforeach
                                                            </ul>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <!-- Single Option -->
                              <div class="single_search_boxed">
                                   <div class="widget-boxed-header">
                                        <h4><a href="#colors" data-toggle="collapse" class="collapsed" aria-expanded="false" role="button">Colors</a></h4>
                                   </div>
                                   <div class="widget-boxed-body collapse" id="colors" data-parent="#colors">
                                        <div class="side-list no-border">
                                             <!-- Single Filter Card -->
                                             <div class="single_filter_card">
                                                  <div class="card-body pt-0">
                                                       <div class="inner_widget_link">
                                                            <ul class="no-ul-list">
                                                                 @foreach ($all_colors as $color)
                                                                      
                                                                 <li>
                                                                      <input id="category1{{$color->id}}" class="color_id" name="color_id" type="radio" value="{{$color->id}}" @if (isset($_GET['color_id']))
                                                                           @if ($_GET['color_id'] == $color->id)
                                                                                checked 
                                                                           @endif
                                                                      @endif>
                                                                      <label for="category1{{$color->id}}" class="checkbox-custom-label">{{$color->color_name}}</label>
                                                                 </li>
                                                                 @endforeach
                                                            </ul>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              
                              <!-- Single Option -->
                              <div class="single_search_boxed">
                                   <div class="widget-boxed-header">
                                        <h4><a href="#size" data-toggle="collapse" class="collapsed" aria-expanded="false" role="button">Size</a></h4>
                                   </div>
                                   <div class="widget-boxed-body collapse" id="size" data-parent="#size">
                                        <div class="side-list no-border">
                                             <!-- Single Filter Card -->
                                             <div class="single_filter_card">
                                                  <div class="card-body pt-0">
                                                       <div class="text-left pb-0 pt-2">
                                                            <div class="inner_widget_link">
                                                            <ul class="no-ul-list">
                                                                 @foreach ($all_sizes as $size)
                                                                      
                                                                 <li>
                                                                      <input id="size{{$size->id}}" class="size_id" name="size_id" type="radio" value="{{$size->id}}" @if (isset($_GET['size_id']))
                                                                           @if ($_GET['size_id'] == $size->id)
                                                                                checked 
                                                                           @endif
                                                                      @endif>
                                                                      <label for="size{{$size->id}}" class="checkbox-custom-label">{{$size->size_name}}</label>
                                                                 </li>
                                                                 @endforeach
                                                            </ul>
                                                       </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                         </div>
                    </div>
               </div>
               
               <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                    
                    <div class="row">
                         <div class="col-xl-12 col-lg-12 col-md-12">
                              <div class="border mb-3 mfliud">
                                   <div class="row align-items-center py-2 m-0">
                                        <div class="col-xl-3 col-lg-4 col-md-5 col-sm-12">
                                             <h6 class="mb-0">Searched Products Found</h6>
                                        </div>
                                        
                                        <div class="col-xl-9 col-lg-8 col-md-7 col-sm-12">
                                             <div class="filter_wraps d-flex align-items-center justify-content-end m-start">
                                                  <div class="single_fitres mr-2 br-right">
                                                       <select class="custom-select simple" id="sort">
                                                            <option value="0" selected="">Default Sorting</option>
                                                            <option value="1">Sort by: (A-Z)</option>
                                                            <option value="2">Sort by: (Z-A)</option>
                                                            <option value="3">Sort by Price: (Low - High)</option>
                                                            <option value="4">Sort by Price: (High - Low)</option>
                                                       </select>
                                                  </div>
                                                  
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    
                    <!-- row -->
                    <div class="row align-items-center rows-products">
                         
                         <!-- Single -->
                         @foreach ($all_products as $product)
                              <div class="col-xl-4 col-lg-4 col-md-6 col-6">
                                   <div class="product_grid card b-0">
                                        <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">New</div>
                                        <div class="card-body p-0">
                                             <div class="shop_thumb position-relative">
                                                  <a class="card-img-top d-block overflow-hidden" href="{{route('product.details',$product->slug)}}"><img class="card-img-top" src="{{asset('uploads/preview')}}/{{$product->preview}}" alt="..."></a>
                                             </div>
                                        </div>
                                        <div class="card-footer b-0 p-0 pt-2 bg-white">
                                             
                                             <div class="text-left">
                                                  <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="{{route('product.details',$product->slug)}}">{{$product->product_name}}</a></h5>
                                                  <div class="elis_rty"><span class="ft-bold text-dark fs-sm"><i class="fa-solid fa-bangladeshi-taka-sign"></i> {{$product->after_discount}}</span></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         @endforeach
                         
                    </div>
                    <!-- row -->
               </div>
          </div>
     </div>
</section>
<!-- ======================= All Product List ======================== -->
@endsection
@section('footer_script')
<script>
     $('#search_btn').click(function(){
          var search_input = $('#search_input').val();
          var category_id = $('input[class="category_id"]:checked').val();
          var color_id = $('input[class="color_id"]:checked').val();
          var size_id = $('input[class="size_id"]:checked').val();
          var min = $('#min').val();
          var max = $('#max').val();
          var sort = $('#sort :selected').val();
          var link ="{{route('shop.details')}}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sort="+sort;
          window.location.href = link;
     });
     $('#range').click(function(){
          var search_input = $('#search_input').val();
          var category_id = $('input[class="category_id"]:checked').val();
          var color_id = $('input[class="color_id"]:checked').val();
          var size_id = $('input[class="size_id"]:checked').val();
          var min = $('#min').val();
          var max = $('#max').val();
          var sort = $('#sort :selected').val();
          var link ="{{route('shop.details')}}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sort="+sort;
          window.location.href = link;
     });
     $('.category_id').click(function(){
          var search_input = $('#search_input').val();
          var category_id = $('input[class="category_id"]:checked').val();
          var color_id = $('input[class="color_id"]:checked').val();
          var size_id = $('input[class="size_id"]:checked').val();
          var min = $('#min').val();
          var max = $('#max').val();
          var sort = $('#sort :selected').val();
          var link ="{{route('shop.details')}}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sort="+sort;
          window.location.href = link;
     });
     $('.color_id').click(function(){
          var search_input = $('#search_input').val();
          var category_id = $('input[class="category_id"]:checked').val();
          var color_id = $('input[class="color_id"]:checked').val();
          var size_id = $('input[class="size_id"]:checked').val();
          var min = $('#min').val();
          var max = $('#max').val();
          var sort = $('#sort :selected').val();
          var link ="{{route('shop.details')}}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sort="+sort;
          window.location.href = link;
     });
     $('.size_id').click(function(){
          var search_input = $('#search_input').val();
          var category_id = $('input[class="category_id"]:checked').val();
          var color_id = $('input[class="color_id"]:checked').val();
          var size_id = $('input[class="size_id"]:checked').val();
          var min = $('#min').val();
          var max = $('#max').val();
          var sort = $('#sort :selected').val();
          var link ="{{route('shop.details')}}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sort="+sort;
          window.location.href = link;
     });
     $('#sort').change(function(){
          var search_input = $('#search_input').val();
          var category_id = $('input[class="category_id"]:checked').val();
          var color_id = $('input[class="color_id"]:checked').val();
          var size_id = $('input[class="size_id"]:checked').val();
          var min = $('#min').val();
          var max = $('#max').val();
          var sort = $('#sort :selected').val();
          var link ="{{route('shop.details')}}"+"?q="+search_input+"&category_id="+category_id+"&color_id="+color_id+"&size_id="+size_id+"&min="+min+"&max="+max+"&sort="+sort;
          window.location.href = link;
     });
</script>
@endsection