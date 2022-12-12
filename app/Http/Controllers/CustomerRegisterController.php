<?php

namespace App\Http\Controllers;

use App\Models\CustomerEmailVerify;
use App\Models\CustomerLogin;
use App\Notifications\EmailverifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Notification;

class CustomerRegisterController extends Controller
{
    function customer_login_register(){
        return view('frontend.customer_register');
    }
    function customer_register(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=> ['required',Password::min(8)->letters()->mixedCase()->numbers()->symbols()->uncompromised()],
        ]);
        Customerlogin::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);
        $customer = Customerlogin::where('email',$request->email)->firstOrFail();
        CustomerEmailVerify::where('customer_id',$customer->id)->delete();
         $email_verify = CustomerEmailVerify::create([
            'customer_id'=>$customer->id,
            'verify_token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);
         Notification::send($customer, new EmailverifyNotification($email_verify));
        return back()->with('customer_register','Registration Successfully Done! Please Verify Your Email');
    }
}
