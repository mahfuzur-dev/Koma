<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function add_cart(Request $request){
        $request->validate([
            'color_id'=>'required',
            'size_id'=>'required',
        ]);
        Cart::insert([
            'customer_id'=>Auth::guard('customerlogin')->id(),
            'product_id'=>$request->product_id,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
            'quantity'=>$request->quantity,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('cart_success','Cart Added!');
    }
    function delete_cart($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }
    function view_cart(Request $request){
        $coupon = $request->coupon;
        $message = null;
        $type = null;
        if($coupon == ''){
            $discount = 0;
        }
        else{
            if(Coupon::where('coupon_name',$coupon)->exists()){
               if(Carbon::now()->format('Y-m-d') > Coupon::where('coupon_name',$coupon)->first()->validity){
                    $message = 'Coupon Code Expired!';
                    $discount = 0;
               }
               else{
                    $discount = Coupon::where('coupon_name',$coupon)->first()->amount;
                    $type = Coupon::where('coupon_name',$coupon)->first()->type;
               }
            }
            else{
                $message = 'Invalid Coupon Code';
                $discount = 0;
            }
        }
        $all_carts = Cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
        return view('frontend.view_cart',[
            'all_carts'=>$all_carts,
            'discount'=>$discount,
            'message'=>$message,
            'type'=>$type,
        ]);
    }
    function update_cart(Request $request){
        foreach($request->quantity as $cart_id=>$quantity){
            Cart::find($cart_id)->update([
                'quantity'=>$quantity,
                'created_at'=>Carbon::now(),
            ]);
        }
        return back();
    }
}
