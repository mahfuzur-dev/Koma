@extends('frontend.master')
@section('content')
<div class="gray py-3">
     <div class="container">
          <div class="row">
               <div class="colxl-12 col-lg-12 col-md-12">
                    <nav aria-label="breadcrumb">
                         <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{route('frontend')}}">Home</a></li>
                              <li class="breadcrumb-item"><a href="{{route('frontend')}}">Product</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Product Details</li>
                         </ol>
                    </nav>
               </div>
          </div>
     </div>
</div>
<!-- ======================= Product Detail ======================== -->
@php
     if($total_review == 0){
          $avg =0;
     }
     else {
          $avg = round($total_star/$total_review);
     }
@endphp
<section class="middle">
     <div class="container">
          <div class="row justify-content-between">
          
               <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12">
                    <div class="quick_view_slide">
                         @foreach ($thumbnails as $thumbnail)
                              
                         <div class="single_view_slide"><a href="" data-lightbox="roadtrip" class="d-block mb-4"><img src="{{asset('uploads/thumbnail')}}/{{$thumbnail->thumbnail}}" class="img-fluid rounded" alt="" /></a></div>
                         
                         @endforeach
                    </div>
               </div>
               
               <div class="col-xl-7 col-lg-6 col-md-12 col-sm-12">
                    <div class="prd_details pl-3">
                         
                         <div class="prt_01 mb-1"><span class="text-light bg-info rounded px-2 py-1">{{$product_info->first()->rel_to_subcategory->subcategory_name}}</span></div>
                         <div class="prt_02 mb-3">
                              <h2 class="ft-bold mb-1">{{$product_info->first()->product_name}}</h2>
                              <div class="text-left">
                                   <div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                        @for ($i=1;$i<=$avg;$i++)
                                            <i class="fas fa-star filled"></i>
                                        @endfor
                                        <span class="small">({{$total_review}} Reviews)</span>
                                   </div>
                                   <div class="elis_rty">
                                        @if ($product_info->first()->discount)
                                             <span class="ft-medium text-muted line-through fs-md mr-2"><i class="fa-solid fa-bangladeshi-taka-sign"></i> {{$product_info->first()->product_price}}</span>
                                        @endif
                                        <span class="ft-bold theme-cl fs-lg mr-2"><i class="fa-solid fa-bangladeshi-taka-sign"></i> <strong id="price">{{$product_info->first()->after_discount}}</strong></span></div>
                              </div>
                         </div>
                         <div class="prt_03 mb-4">
                              <p>{{$product_info->first()->short_desp}}</p>
                         </div>
                         <form action="{{route('add.cart')}}" method="POST">
                          @csrf 
                              
                              <div class="prt_02 mb-2">
                                   <p class="d-flex align-items-center mb-0 text-dark ft-medium">Color:</p>
                                   <div class="text-left">
                                        <div class="mb-3">
                                             <input type="hidden" name="product_id" value="{{$product_info->first()->id}}">
                                             <select name="color_id" id="color_id">
                                                  <option value="">---Select Color---</option>
                                                  @foreach ($available_colors as $color)
                                                  <option value="{{$color->rel_to_color->id}}">{{$color->rel_to_color->color_name}}</option>
                                                  @endforeach
                                             </select>
                                              @error('color_id')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                        
                                   </div>
                              </div>
                              
                              <div class="prt_04 mb-4">
                                   <p class="d-flex align-items-center mb-0 text-dark ft-medium">Size:</p>
                                   <div class="text-left pb-0 pt-2">
                                        <div class="mb-3">
                                             <select name="size_id" id="size_id">
                                                  <option value="">---Select Size---</option>
                                             </select>
                                             @error('size_id')
                                                  <strong class="text-danger">{{$message}}</strong>
                                             @enderror
                                        </div>
                                   </div>
                              </div>
                              
                              <div class="prt_04 mb-4">
                                   <div class="form-row mb-7">
                                        <div class="col-12 col-lg-auto">
                                             <!-- Quantity -->
                                             <button type="button" class="button_quantity" id="quantity_minus"><i class="fa-solid fa-minus"></i></button>
                                             <input type="number" class="input_quantity" name="quantity" id="quantity" readonly type="number" value="1">
                                             <button type="button" class="button_quantity" id="quantity_plus"><i class="fa-solid fa-plus"></i></button>
                                             <span class="ft-bold theme-cl fs-lg mr-2 pl-5">Price: <i class="fa-solid fa-bangladeshi-taka-sign"></i> <strong id="total">{{$product_info->first()->after_discount}}</strong></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="mb-3" id="cart">
                                   <!-- Submit -->
                                   <button type="submit" class="btn btn-dark">
                                        <i class="lni lni-shopping-basket mr-2"></i>Add to Cart 
                                   </button>
                              </div>
                              @if (session('cart_success'))
                   
                               @endif
                         </form>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- ======================= Product Detail End ======================== -->

<!-- ======================= Product Description ======================= -->
<section class="middle">
     <div class="container">
          <div class="row align-items-center justify-content-center">
               <div class="col-xl-11 col-lg-12 col-md-12 col-sm-12">
                    <ul class="nav nav-tabs b-0 d-flex align-items-center justify-content-center simple_tab_links mb-4" id="myTab" role="tablist">
                         <li class="nav-item" role="presentation">
                              <a class="nav-link active" id="description-tab" href="#description" data-toggle="tab" role="tab" aria-controls="description" aria-selected="true">Description</a>
                         </li>
                         <li class="nav-item" role="presentation">
                              <a class="nav-link" href="#information" id="information-tab" data-toggle="tab" role="tab" aria-controls="information" aria-selected="false">Additional information</a>
                         </li>
                         <li class="nav-item" role="presentation">
                              <a class="nav-link" href="#reviews" id="reviews-tab" data-toggle="tab" role="tab" aria-controls="reviews" aria-selected="false">Reviews ({{$total_review}})</a>
                         </li>
                    </ul>
                    
                    <div class="tab-content" id="myTabContent">
                         
                         <!-- Description Content -->
                         <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                              <div class="description_info">
                                   <p class="p-0 mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                                   <p class="p-0">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
                              </div>
                         </div>
                         
                         <!-- Additional Content -->
                         <div class="tab-pane fade" id="information" role="tabpanel" aria-labelledby="information-tab">
                              <div class="additionals">
                                   <table class="table">
                                        <tbody>
                                             <tr>
                                                  <th class="ft-medium text-dark">ID</th>
                                                  <td>#1253458</td>
                                             </tr>
                                             <tr>
                                                  <th class="ft-medium text-dark">SKU</th>
                                                  <td>KUM125896</td>
                                             </tr>
                                             <tr>
                                                  <th class="ft-medium text-dark">Color</th>
                                                  <td>Sky Blue</td>
                                             </tr>
                                             <tr>
                                                  <th class="ft-medium text-dark">Size</th>
                                                  <td>Xl, 42</td>
                                             </tr>
                                             <tr>
                                                  <th class="ft-medium text-dark">Weight</th>
                                                  <td>450 Gr</td>
                                             </tr>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                         
                         <!-- Reviews Content -->
                         <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                              <div class="reviews_info">

                                   <!-- Single Review -->
                                   @foreach ($order_products as $review)
                                       <div class="single_rev d-flex align-items-start br-bottom py-3">
                                        <div class="single_rev_thumb"><img src="assets/img/team-2.jpg" class="img-fluid circle" width="90" alt="" /></div>
                                        <div class="single_rev_caption d-flex align-items-start pl-3">
                                             <div class="single_capt_left">
                                                  <h5 class="mb-0">{{$review->rel_to_customer->name}}</h5>
                                                  <span class="small">{{$review->created_at->format('d.M.Y')}}</span>
                                                  <div class="single_capt_right text-right">
                                                  <div class="star-rating align-items-center d-flex justify-content-left mb-1 p-0">
                                                       @for ($i=1;$i<=$review->star;$i++)
                                                            <i class="fas fa-star filled"></i>
                                                       @endfor
                                                  </div>
                                             </div>
                                                  <p>{{$review->review}}</p>
                                             </div>
                                             
                                        </div>
                                        </div>
                                   @endforeach
                                   
                              </div>
                              @auth('customerlogin')
                                    @if (App\Models\OrderProduct::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$product_info->first()->id)->exists())

                                    @if (App\Models\OrderProduct::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$product_info->first()->id)->where('review','!=',null)->first() == false)
                                        <div class="reviews_rate">
                                             <form class="row" action="{{route('review')}}" method="POST">
                                                  @csrf
                                                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                       <h4>Submit Rating</h4>
                                                  </div>
                                                  
                                                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                       @if (session('review'))
                                                            <div class="alert alert-success">{{session('review')}}</div>
                                                       @endif
                                                       <div class="revie_stars d-flex align-items-center justify-content-between px-2 py-2 gray rounded mb-2 mt-1">
                                                            <div class="srt_013">
                                                                 <div class="submit-rating">
                                                                      <input id="star-5" class="star" type="radio" value="5" />
                                                                      <label for="star-5" title="5 stars">
                                                                      <i class="active fa fa-star" aria-hidden="true"></i>
                                                                      </label>
                                                                      <input id="star-4" class="star" type="radio" value="4" />
                                                                      <label for="star-4" title="4 stars">
                                                                      <i class="active fa fa-star" aria-hidden="true"></i>
                                                                      </label>
                                                                      <input id="star-3" class="star" type="radio" value="3" />
                                                                      <label for="star-3" title="3 stars">
                                                                      <i class="active fa fa-star" aria-hidden="true"></i>
                                                                      </label>
                                                                      <input id="star-2" class="star" type="radio" value="2" />
                                                                      <label for="star-2" title="2 stars">
                                                                      <i class="active fa fa-star" aria-hidden="true"></i>
                                                                      </label>
                                                                      <input id="star-1" class="star" type="radio" value="1" />
                                                                      <label for="star-1" title="1 star">
                                                                      <i class="active fa fa-star" aria-hidden="true"></i>
                                                                      </label>
                                                                 </div>
                                                                 <input type="hidden" name="product_id" value="{{$product_info->first()->id}}">
                                                                 <input type="hidden" name="star" id="star" value="">
                                                            </div>
                                                            
                                                            <div class="srt_014">
                                                                 <h6 class="mb-0">4 Star</h6>
                                                            </div>
                                                       </div>
                                                  </div>
                                                  
                                                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                       <div class="form-group">
                                                            <label class="medium text-dark ft-medium">Full Name</label>
                                                            <input type="text" class="form-control" value="{{Auth::guard('customerlogin')->user()->name}}" name="name"/>
                                                       </div>
                                                  </div>
                                                  
                                                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                                       <div class="form-group">
                                                            <label class="medium text-dark ft-medium">Email Address</label>
                                                            <input type="email" class="form-control" value="{{Auth::guard('customerlogin')->user()->email}}" name="email"/>
                                                       </div>
                                                  </div>
                                                  
                                                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                       <div class="form-group">
                                                            <label class="medium text-dark ft-medium">Description</label>
                                                            <textarea class="form-control" name="review"></textarea>
                                                       </div>
                                                  </div>
                                                  
                                                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                                       <div class="form-group m-0">
                                                            <button type="submit" class="btn btn-white stretched-link hover-black">Submit Review <i class="lni lni-arrow-right"></i></button>
                                                       </div>
                                                  </div>
                                                  
                                             </form>
                                        </div>
                                         @else
                                        <div class="alert alert-danger">
                                              <h3>Already You reviewed this Product</h3>
                                         </div>
                                    @endif    
                                        @else
                                        <div class="alert alert-danger">
                                        <h3>You did not purchase this product yet</h3>
                                         </div>
                                    @endif
                              @else
                                   <div class="alert alert-danger">
                                        <h3>Please Sign in to Review This Product  <a href="{{route('customer.login.register')}}" class="btn btn-warning float-end">SignIn</a></h3>
                                   </div>
                              @endauth
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- ======================= Product Description End ==================== -->

<!-- ======================= Similar Products Start ============================ -->
<section class="middle pt-0">
     <div class="container">
          
          <div class="row justify-content-center">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="sec_title position-relative text-center">
                         <h2 class="off_title">Similar Products</h2>
                         <h3 class="ft-bold pt-3">Matching Producta</h3>
                    </div>
               </div>
          </div>
          
          <div class="row">
               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="slide_items">
                         
                         <!-- single Item -->
                         <div class="single_itesm">
                              <div class="product_grid card b-0 mb-0">
                                   <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                                   <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                             <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img class="card-img-top" src="assets/img/product/16.png" alt="..."></a>
                                        </div>
                                   </div>
                                   <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
                                        <div class="text-left">
                                             <div class="text-center">
                                                  <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="shop-single-v1.html">Half Running Set</a></h5>
                                                  <div class="elis_rty"><span class="ft-bold fs-md text-dark">$119.00</span></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         
                         <!-- single Item -->
                         <div class="single_itesm">
                              <div class="product_grid card b-0 mb-0">
                                   <div class="badge bg-info text-white position-absolute ft-regular ab-left text-upper">New</div>
                                   <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                             <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img class="card-img-top" src="assets/img/product/17.png" alt="..."></a>
                                        </div>
                                   </div>
                                   <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
                                        <div class="text-left">
                                             <div class="text-center">
                                                  <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="shop-single-v1.html">Formal Men Lowers</a></h5>
                                                  <div class="elis_rty"><span class="text-muted ft-medium line-through mr-2">$129.00</span><span class="ft-bold theme-cl fs-md">$79.00</span></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         
                         <!-- single Item -->
                         <div class="single_itesm">
                              <div class="product_grid card b-0 mb-0">
                                   <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                             <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img class="card-img-top" src="assets/img/product/18.png" alt="..."></a>
                                        </div>
                                   </div>
                                   <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
                                        <div class="text-left">
                                             <div class="text-center">
                                                  <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="shop-single-v1.html">Half Running Suit</a></h5>
                                                  <div class="elis_rty"><span class="ft-bold fs-md text-dark">$80.00</span></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         
                         <!-- single Item -->
                         <div class="single_itesm">
                              <div class="product_grid card b-0 mb-0">
                                   <div class="badge bg-warning text-white position-absolute ft-regular ab-left text-upper">Hot</div>
                                   <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                             <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img class="card-img-top" src="assets/img/product/19.png" alt="..."></a>
                                        </div>
                                   </div>
                                   <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
                                        <div class="text-left">
                                             <div class="text-center">
                                                  <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="shop-single-v1.html">Half Fancy Lady Dress</a></h5>
                                                  <div class="elis_rty"><span class="text-muted ft-medium line-through mr-2">$149.00</span><span class="ft-bold theme-cl fs-md">$110.00</span></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         
                         <!-- single Item -->
                         <div class="single_itesm">
                              <div class="product_grid card b-0 mb-0">
                                   <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                             <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img class="card-img-top" src="assets/img/product/20.png" alt="..."></a>
                                        </div>
                                   </div>
                                   <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
                                        <div class="text-left">
                                             <div class="text-center">
                                                  <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="shop-single-v1.html">Flix Flox Jeans</a></h5>
                                                  <div class="elis_rty"><span class="text-muted ft-medium line-through mr-2">$90.00</span><span class="ft-bold theme-cl fs-md">$49.00</span></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         
                         <!-- single Item -->
                         <div class="single_itesm">
                              <div class="product_grid card b-0 mb-0">
                                   <div class="badge bg-danger text-white position-absolute ft-regular ab-left text-upper">Hot</div>
                                   <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                             <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img class="card-img-top" src="assets/img/product/21.png" alt="..."></a>
                                        </div>
                                   </div>
                                   <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
                                        <div class="text-left">
                                             <div class="text-center">
                                                  <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="shop-single-v1.html">Fancy Salwar Suits</a></h5>
                                                  <div class="elis_rty"><span class="ft-bold fs-md text-dark">$114.00</span></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         
                         <!-- single Item -->
                         <div class="single_itesm">
                              <div class="product_grid card b-0 mb-0">
                                   <div class="badge bg-success text-white position-absolute ft-regular ab-left text-upper">Sale</div>
                                   <div class="card-body p-0">
                                        <div class="shop_thumb position-relative">
                                             <a class="card-img-top d-block overflow-hidden" href="shop-single-v1.html"><img class="card-img-top" src="assets/img/product/22.png" alt="..."></a>
                                        </div>
                                   </div>
                                   <div class="card-footer b-0 p-3 pb-0 d-flex align-items-start justify-content-center">
                                        <div class="text-left">
                                             <div class="text-center">
                                                  <h5 class="fw-bolder fs-md mb-0 lh-1 mb-1"><a href="shop-single-v1.html">Collot Full Dress</a></h5>
                                                  <div class="elis_rty"><span class="ft-bold theme-cl fs-md text-dark">$120.00</span></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         
                    </div>
               </div>
          </div>
          
     </div>
</section>
<!-- ======================= Similar Products Start ============================ -->
@endsection
@section('footer_script')
<script>
     $("#color_id").change(function(){
          var color_id = $(this).val();
          var product_id = "{{$product_info->first()->id}}";
         
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
          });
          $.ajax({
               type:'POST',
               url:'/getsize',
               data:{'color_id':color_id,'product_id':product_id},
               success:function(data){
                   $('#size_id').html(data);
               }
          })
     })
</script>
<script>
     $("#size_id").change(function(){
          var color_id = $('.color_id').attr('data-col');
          var product_id = "{{$product_info->first()->id}}";
          var size_id = $(this).val();
         
          $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
          });
          $.ajax({
               type:'POST',
               url:'/getStock',
               data:{'color_id':color_id,'product_id':product_id,'size_id':size_id},
               success:function(data){
                  $('#cart').html(data)
               }
          })
     })
</script>
<script>
     var quantity = $('#quantity').val()
     $('#quantity_plus').click(function(){
          quantity++
          $('#quantity').val(quantity);
          var price = $('#price').html();
          var total = quantity*price;
          $('#total').html(total)
     });
     $('#quantity_minus').click(function(){
          if(quantity > 1){
               quantity--
          }
          $('#quantity').val(quantity);
          var price = $('#price').html();
          var total = quantity*price;
          $('#total').html(total)
     });
</script>
     @if (session('cart_success'))
       <script>
              swal({
               title: "Good job!",
               text: "{{session('cart_success')}}",
               type: "success",
               confirmButtonText: "Ok"
               });
          </script>
  @endif
  <script>
     $('.star').click(function(){
          var star = $(this).val();
          $('#star').val(star);
     })
  </script>
@endsection
