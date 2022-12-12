<?php

namespace App\Http\Controllers;

use App\Models\CustomerLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class CustomerLoginController extends Controller
{
    function customer_login_view(){
        return view('frontend.customer_login_');
    }
    function customer_login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>['required',Password::min(8)
                            ->letters()
                            ->mixedCase()
                            ->numbers()
                            ->symbols()
                            ->uncompromised()],
        ]);
        if(Auth::guard('customerlogin')->attempt(['email'=>$request->email,'password'=>$request->password])){
            if(Auth::guard('customerlogin')->user()->email_verified_at == null){
                Auth::guard('customerlogin')->logout();
                return redirect()->route('customer.login.register')->with('customer_register','Please Verify Your Email');
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect()->route('customer.login.register');
        }
    }
    function customer_logout(){
        Auth::guard('customerlogin')->logout();
        return redirect()->route('customer.login.register');
    }
}
