<?php

namespace App\Http\Controllers;

use App\Mail\CustomerInvoice;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\City;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    function getCity(Request $request){
        $str = '<option value="">-- Select City --</option>';
        $cities = City::where('country_id',$request->country_id)->get();
        foreach($cities as $city){
            $str .= '<option value="'.$city->id.'">'.$city->name.'</option>';
        }
        echo $str;
    }
    function add_orders(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'country_id'=>'required',
            'city_id'=>'required',
            'city_id'=>'required',
            'delivery'=>'required',
            'payment_method'=>'required',
        ]);
        if($request->payment_method == 1){
            $order_id = Order::insertGetId([
            'customer_id'=>Auth::guard('customerlogin')->id(),
            'sub_total'=>$request->sub_total,
            'discount'=>$request->discount,
            'delivery'=>$request->delivery,
            'total'=>$request->sub_total+$request->delivery-$request->discount,
            'created_at'=>Carbon::now(),
            ]);
            Billing::insert([
                'order_id'=>$order_id,
                'customer_id'=>Auth::guard('customerlogin')->id(),
                'name'=>$request->name,
                'email'=>$request->email,
                'company'=>$request->company,
                'mobile'=>$request->mobile,
                'address'=>$request->address,
                'country_id'=>$request->country_id,
                'city_id'=>$request->city_id,
                'zip'=>$request->zip,
                'note'=>$request->note,
                'created_at'=>Carbon::now(),
            ]);
            $carts = Cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
            foreach($carts as $cart){
                OrderProduct::insert([
                    'order_id'=>$order_id,
                    'customer_id'=>Auth::guard('customerlogin')->id(),
                    'product_id'=>$cart->product_id,
                    'color_id'=>$cart->color_id,
                    'size_id'=>$cart->size_id,
                    'price'=>$cart->rel_to_product->after_discount,
                    'quantity'=>$cart->quantity,
                    'created_at'=>Carbon::now(),
                ]);
                Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->decrement('quantity',$cart->quantity);
                Cart::find($cart->id)->delete();
            }
            Mail::to($request->email)->send(new CustomerInvoice($order_id));
            return redirect()->route('order.success')->with('order_success','Your Order is Completed!');
        }
        else{
            $data = $request->all();
            return view('exampleHosted',[
                'data'=>$data,
            ]);
        }
        
    }
    function order_success(){
        if(session('order_success')){
            return view('frontend.order_success',[
            ]);
        }
        else{
            return view('errors.404');
        }
        
    }
}
