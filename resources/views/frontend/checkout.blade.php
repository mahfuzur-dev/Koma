@extends('frontend.master')
@section('content')
<!-- ======================= Top Breadcrubms ======================== -->
<div class="gray py-3">
<div class="container">
     <div class="row">
          <div class="colxl-12 col-lg-12 col-md-12">
               <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                         <li class="breadcrumb-item"><a href="#">Home</a></li>
                         <li class="breadcrumb-item"><a href="#">Support</a></li>
                         <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
               </nav>
          </div>
     </div>
</div>
</div>
<!-- ======================= Top Breadcrubms ======================== -->

<!-- ======================= Product Detail ======================== -->
<section class="middle">
<div class="container">

     <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
               <div class="text-center d-block mb-5">
                    <h2>Checkout</h2>
               </div>
          </div>
     </div>
     
     <div class="row justify-content-between">
          <div class="col-12 col-lg-7 col-md-12">
               <form action="{{route('add.orders')}}" method="POST">
                    @csrf
                    <h5 class="mb-4 ft-medium">Billing Details</h5>
                    <div class="row mb-2">
                       <form action="">  
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                              <div class="form-group">
                                   <input type="hidden" value="{{ Auth::guard('customerlogin')->id() }}" name="customer_id" />
                                   <label class="text-dark">Full Name *</label>
                                   <input type="text" name="name" class="form-control" value="{{Auth::guard('customerlogin')->user()->name}}" />
                                   @error('name')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                              <div class="form-group">
                                   <label class="text-dark">Email *</label>
                                   <input type="email" name="email" class="form-control" value="{{Auth::guard('customerlogin')->user()->email}}" />
                                   @error('email')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                         </div>
                         
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                              <div class="form-group">
                                   <label class="text-dark">Company</label>
                                   <input type="text" name="company" class="form-control" placeholder="Company Name (optional)" />
                              </div>
                         </div>
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                              <div class="form-group">
                                   <label class="text-dark">Mobile Number *</label>
                                   <input type="text" name="mobile" class="form-control" placeholder="Mobile Number" />
                                   @error('mobile')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                         </div>
                         
                         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                   <label class="text-dark">Address *</label>
                                   <input type="text" name="address" class="form-control" placeholder="Address" />
                                   @error('address')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                         </div>
                         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                   <label class="text-dark">Country *</label>
                                   <select name="country_id" id="country_id" class="custom-select py-2 search">
                                        <option value="">-- Select Country --</option>
                                        @foreach ($all_countries as $country)
                                             <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                   </select>
                                   @error('country_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                         </div>
                         
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                              <div class="form-group">
                                   <label class="text-dark">City / Town *</label>
                                   <select name="city_id" id="city_id" class="custom-select">
                                        <option value="">-- Select City --</option>
                                   </select>
                                   @error('city_id')
                                        <strong class="text-danger">{{$message}}</strong>
                                   @enderror
                              </div>
                         </div>
                         
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                              <div class="form-group">
                                   <label class="text-dark">ZIP / Postcode *</label>
                                   <input type="text" class="form-control" name="zip" placeholder="Zip / Postcode" />
                              </div>
                         </div>
                         
                         <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                   <label class="text-dark">Additional Information</label>
                                   <textarea class="form-control ht-50" name="note"></textarea>
                              </div>
                         </div>
                         
                    </div>
               
          </div>
          
          <!-- Sidebar -->
          <div class="col-12 col-lg-4 col-md-12">
               <div class="d-block mb-3">
                    <h5 class="mb-4">Order Items ({{$all_carts_count}})</h5>
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                         @php
                              $sub_total =0;
                              foreach ($all_carts as $cart) {
                                   $sub_total += $cart->rel_to_product->after_discount*$cart->quantity;
                              }
                         @endphp
                         @foreach ($all_carts as $cart)
                              
                         <li class="list-group-item">
                              <div class="row align-items-center">
                                   <div class="col-3">
                                        <!-- Image -->
                                        <a href="product.html"><img src="{{asset('uploads/preview')}}/{{$cart->rel_to_product->preview}}" alt="..." class="img-fluid"></a>
                                   </div>
                                   <div class="col d-flex align-items-center">
                                        <div class="cart_single_caption pl-2">
                                             <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{$cart->rel_to_product->product_name}}</h4>
                                             <p class="mb-1 lh-1"><span class="text-dark">Size: {{$cart->rel_to_size->size_name}}</span></p>
                                             <p class="mb-3 lh-1"><span class="text-dark">Color: {{$cart->rel_to_color->color_name}}</span></p>
                                             <p class="mb-3 lh-1"><span class="text-dark">Quantity: {{$cart->quantity}}</span></p>
                                             <h4 class="fs-md ft-medium mb-3 lh-1"><i class="fa-solid fa-bangladeshi-taka-sign"></i>   {{$cart->rel_to_product->after_discount}}</h4>
                                        </div>
                                   </div>
                              </div>
                         </li>
                         @endforeach
                         
                    </ul>
               </div>
               
               <div class="mb-4">
                    <div class="form-group">
                         <h6>Delivery Location</h6>
                         <ul class="no-ul-list">
                              <li>
                                   <input type="hidden" id="price" value="{{$sub_total-session('final_discount')}}">
                                   <input id="c1" class="radio-custom delivery_btn" name="delivery" type="radio" value="100">
                                   <label for="c1" class="radio-custom-label" name="delivery">Inside City</label>
                              </li>
                              <li>
                                   <input id="c2" class="radio-custom delivery_btn" name="delivery"  type="radio" value="200">
                                   <label for="c2" class="radio-custom-label" name="delivery">Outside City</label>
                              </li>
                               @error('delivery')
                                   <strong class="text-danger">{{$message}}</strong>
                              @enderror
                         </ul>
                    </div>
               </div>
               <div class="mb-4">
                    <div class="form-group">
                         <h6>Select Payment Method</h6>
                         <ul class="no-ul-list">
                              <li>
                                   <input id="c3" class="radio-custom" name="payment_method" type="radio" value="1">
                                   <label for="c3" class="radio-custom-label">Cash on Delivery</label>
                              </li>
                              <li>
                                   <input id="c4" class="radio-custom" name="payment_method" type="radio" value="2">
                                   <label for="c4" class="radio-custom-label">Pay With SSLCommerz</label>
                              </li>
                              @error('payment_method')
                                   <strong class="text-danger">{{$message}}</strong>
                              @enderror
                         </ul>
                    </div>
               </div>
               
               <div class="card mb-4 gray">
                    <div class="card-body">
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                         <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                         <span>Subtotal</span> <span class="ml-auto text-dark ft-medium"><i class="fa-solid fa-bangladeshi-taka-sign"></i>   {{$sub_total}}</span>
                         <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                         <span>Discount</span> <span class="ml-auto text-dark ft-medium"><i class="fa-solid fa-bangladeshi-taka-sign"></i>   {{session('final_discount')}}</span>
                         </li>
                         <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                         <span>Charge</span> <span class="ml-auto text-dark ft-medium"><i class="fa-solid fa-bangladeshi-taka-sign"></i> <strong id="charge">0</strong>   </span>
                         </li>
                         </li>
                         <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                         <span>Total</span><span class="ml-auto text-dark ft-medium"><i class="fa-solid fa-bangladeshi-taka-sign"></i><strong id="total">{{$sub_total-session('final_discount')}}</strong></span>
                         </li>
                         <input type="hidden" name="sub_total" value="{{$sub_total}}">
                         <input type="hidden" name="discount" value="{{session('final_discount')}}">
                         
                    </ul>
                    </div>
               </div>

               
               <button type="submit" class="btn btn-block btn-dark mb-3">Place Your Order</button>
          </div>
          </form>
     </div>
     
</div>
</section>
<!-- ======================= Product Detail End ======================== -->

@endsection
@section('footer_script')
<script>
     $('#country_id').change(function(){
          var country_id = $(this).val();

           $.ajaxSetup({
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
          });
          $.ajax({
               type:'POST',
               url:'/getCity',
               data:{'country_id': country_id},
               success:function(data){
                    $('#city_id').html(data);
               }
          })
     }) 
    
</script>
<script>
     $(document).ready(function() {
           $('.search').select2();
     });
     $(document).ready(function() {
           $('#city_id').select2();
     });
</script>
<script>
     $('.delivery_btn').click(function(){
          var charge = parseInt( $(this).val());
          var price = parseInt($('#price').val());
          var total = charge+price;
          $('#charge').html(charge);
          $('#total').html(total);
     })
</script>
@endsection