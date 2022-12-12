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
                              <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
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
                         <h2>Shopping Cart</h2>
                    </div>
               </div>
          </div>
          @php
               $sub_total = 0;
          @endphp
          <div class="row justify-content-between">
               <div class="col-12 col-lg-7 col-md-12">
                    <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x mb-4">
                            @foreach ($all_carts as $cart)
                                 <li class="list-group-item">
                                   <div class="row align-items-center">
                                        <div class="col-3">
                                             <!-- Image -->
                                             <a href="product.html"><img src="{{asset('uploads/preview')}}/{{$cart->rel_to_product->preview}}" alt="..." class="img-fluid"></a>
                                             </div>
                                             <div class="col d-flex align-items-center justify-content-between">
                                                  <div class="cart_single_caption pl-2">
                                                       <h4 class="product_title fs-md ft-medium mb-1 lh-1">{{$cart->rel_to_product->product_name}}</h4>
                                                       <p class="mb-1 lh-1"><span class="text-dark">Size: {{$cart->rel_to_size->size_name}}</span></p>
                                                       <p class="mb-3 lh-1"><span class="text-dark">Color: {{$cart->rel_to_color->color_name}}</span></p>
                                                       <h4 class="fs-md ft-medium mb-3 lh-1 abc"><i class="fa-solid fa-bangladeshi-taka-sign"></i> <strong id="price">{{$cart->rel_to_product->after_discount}}</strong></h4>
                                                       <!-- Quantity -->
                                                       <form action="{{route('update.cart')}}" method="POST">
                                                            @csrf
                                                       
                                                       <div class="quantity_input abc mb-4">
                                                            <button type="button" class="button_quantity" id="quantity_minus"><i data-price="{{ $cart->rel_to_product->after_discount }}" class="fa-solid fa-minus"></i></button>
                                                            <input type="number" class="input_quantity" name="quantity[{{ $cart->id }}]" id="quantity" readonly type="number" value="{{$cart->quantity}}">
                                                            <button type="button" class="button_quantity" id="quantity_plus"><i data-price="{{ $cart->rel_to_product->after_discount }}" class="fa-solid fa-plus"></i></button>
                                                       </div>
                                                            Total Price: <i class="fa-solid fa-bangladeshi-taka-sign abc text-danger">{{$cart->rel_to_product->after_discount * $cart->quantity}}</i> 
                                                  </div>
                                                  <div class="fls_last"><a href="{{route('delete.cart',$cart->id)}}" class="close_slide gray abc"><i class="ti-close"></i></a></div>
                                             </div>
                                        </div>
                                   </li>
                                   @php
                                      $sub_total += $cart->rel_to_product->after_discount * $cart->quantity;
                                   @endphp
                              @endforeach  
                         <div class="row align-items-end justify-content-between mb-10 mb-md-0 mt-5 m-auto">
                              <div class="col-6 col-md-7">
                                   <!-- Update Cart -->
                                   <div iv class="col-12 col-md-auto mfliud">
                                        <button type="submit" class="btn stretched-link borders">Update Cart</button>
                                   </div>
                                   </form>
                              </div>
                         
                         </div>
                              
                    </ul>
                    
          </div> 
          @php
               if($type == 2){
               $final_discount = $sub_total * $discount/100;
               }
               else {
               $final_discount = $discount;
               }
           @endphp
               
               <div class="col-12 col-md-12 col-lg-4">
                    <div class="card mb-4 gray mfliud">
                         <div class="card-body">
                         <ul class="list-group list-group-sm list-group-flush-y list-group-flush-x">
                              <li class="list-group-item d-flex text-dark fs-sm ft-regular abc">
                              <span>Subtotal</span> <span class="ml-auto text-dark ft-medium"><i class="fa-solid fa-bangladeshi-taka-sign"></i> {{$sub_total}}</span>
                              </li>
                              <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                              <span>Discount</span> <span class="ml-auto text-dark ft-medium"><i class="fa-solid fa-bangladeshi-taka-sign"></i> {{$final_discount}}</span>
                              </li>
                              <li class="list-group-item d-flex text-dark fs-sm ft-regular">
                              <span>Total</span> <span class="ml-auto text-dark ft-medium"><i class="fa-solid fa-bangladeshi-taka-sign"></i> {{$sub_total-$final_discount}}</span>
                              </li>
                              <li class="list-group-item fs-sm text-center">
                                   Shipping cost calculated at Checkout *
                              </li>
                         </ul>
                         </div>
                    </div>
                    <div class="row align-items-end justify-content-between mb-10 mb-md-0 mb-5">
                         <div class="col-12 col-md-12">
                              <!-- Coupon -->
                              <strong class="text-danger">{{$message}}</strong>
                              <form class="mb-7 mb-md-0" action="">
                                   
                                   @csrf
                                   <label class="fs-sm ft-medium text-dark">Coupon code:</label>
                                   <div class="row form-row mb-3">
                                        <div class="col">
                                             <input class="form-control" type="text" name="coupon" placeholder="Enter coupon code*">
                                        </div>
                                        <div class="col-auto">
                                             <button class="btn btn-dark" type="submit">Apply</button>
                                        </div>
                                   </div>
                              </form>
                         </div>
                         @php
                              session([
                                   'final_discount'=>$final_discount,
                              ])
                         @endphp
                    </div>
                    
                    <a class="btn btn-block btn-dark mb-3" href="{{route('checkout')}}">Proceed to Checkout</a>
                    
                    <a class="btn-link text-dark ft-medium" href="{{route('frontend')}}">
                         <i class="ti-back-left mr-2"></i> Continue Shopping
                    </a>
               </div>
               
          </div>
          
     </div>
</section>
<!-- ======================= Product Detail End ======================== -->
@endsection
@section('footer_script')
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
<script>
    var quantity_input = document.querySelectorAll('.abc');
    var arr = Array.from(quantity_input);
    arr.map(item=>{
        item.addEventListener('click',function(e){
            if(e.target.className == 'fa-solid fa-plus'){
                e.target.parentElement.previousElementSibling.value++
                var quantity = e.target.parentElement.previousElementSibling.value
                var price = e.target.dataset.price
                item.nextElementSibling.innerHTML = price * quantity
            }
            if(e.target.className == 'fa-solid fa-minus'){
                if(e.target.parentElement.nextElementSibling.value > 1){
                    e.target.parentElement.nextElementSibling.value--
                    var quantity = e.target.parentElement.nextElementSibling.value
                    var price = e.target.dataset.price
                    item.nextElementSibling.innerHTML = price * quantity
                }
            } 
        });
    });
</script>
@endsection