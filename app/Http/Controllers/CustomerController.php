<?php

namespace App\Http\Controllers;

use App\Models\CustomerEmailVerify;
use App\Models\CustomerLogin;
use App\Models\OrderProduct;
use App\Models\Passwordforgate;
use App\Notifications\CustomerPasswrodNotification;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class CustomerController extends Controller
{
    function invoice_download($order_id){
        $pdf = Pdf::loadView('invoice.customerinvoice',[
            'order_id'=>$order_id,
        ]);
        return $pdf->stream('invoice.pdf');
    }
    function review(Request $request){
        OrderProduct::where('customer_id',Auth::guard('customerlogin')->id())->where('product_id',$request->product_id)->update([
            'review' =>$request->review,
            'star' =>$request->star,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('review','Product Review Successfully Done!');
    }
    function password_reset(){
        return view('frontend.password_reset');
    }
    function pass_reset_send(Request $request){
        $customer = CustomerLogin::where('email',$request->email)->firstOrFail();
        Passwordforgate::where('customer_id',$customer->id)->delete();
        $pass_reset = Passwordforgate::create([
            'customer_id'=>$customer->id,
            'reset_token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);
        Notification::send($customer, new CustomerPasswrodNotification($pass_reset));
        return back()->with('pass_reset','Please check your email to verify reset password');
    }
    function pass_res_form($reset_token){
        return view('reset_pass.pass_new',[
            'data'=>$reset_token,
        ]);
    }
    function pass_new_send(Request $request){
        $customer_token = Passwordforgate::where('reset_token',$request->reset_token)->firstOrFail();
        $customer = CustomerLogin::findOrFail($customer_token->customer_id);
        $customer->update([
            'password'=>Hash::make($request->password),
        ]);
        $customer_token->delete(); 
        return redirect('/customer/login/register')->with('pass_reset_success','Your Password Successfully Changed!');
    }
    function verify_email($verify_token){
        $token = CustomerEmailVerify::where('verify_token',$verify_token)->firstOrFail();
        $customer = CustomerLogin::findOrFail($token->customer_id); 
        $customer->update([
            'email_verified_at'=>Carbon::now(),
        ]);
        $token->delete();
        return redirect('/customer/register')->with('email_verify','Your Email verified Success');
    }
}
