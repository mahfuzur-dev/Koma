<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    function coupon(){
        $all_coupons = Coupon::all();
        return view('admin.coupon.index',[
            'all_coupons'=>$all_coupons,
        ]);
    }
    function add_coupon(Request $request){
        $request->validate([
            'coupon_name'=>'required',
            'type'=>'required',
            'amount'=>'required',
            'validity'=>'required',
        ]);
        Coupon::insert([
            'coupon_name'=>$request->coupon_name,
            'type'=>$request->type,
            'amount'=>$request->amount,
            'validity'=>$request->validity,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('coupon_success','Coupon Successfully Added!');
    }
    function delete_coupon($coupon_id){
        Coupon::find($coupon_id)->delete();
        return back()->with('coupon_del','Coupon Successfully Deleted!');
    }
}
