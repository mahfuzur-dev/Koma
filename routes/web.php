<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//=====Frontend==============//
Route::get('/',[FrontendController::class,'frontend'])->name('frontend');
Route::get('/product/details/{product_slug}',[FrontendController::class,'product_details'])->name('product.details');
Route::post('/getsize',[FrontendController::class,'getsize']);
Route::post('/getStock',[FrontendController::class,'getStock']);
Route::get('/checkout',[FrontendController::class,'checkout'])->name('checkout');
Route::get('/account',[FrontendController::class,'account'])->name('account');
Route::get('/profile/info',[FrontendController::class,'profile_info'])->name('profile.info');
Route::get('/wish/info',[FrontendController::class,'wish_info'])->name('wish.info');
Route::get('/wish/delete/{wish_id}',[FrontendController::class,'wish_delete'])->name('delete.wish');
Route::post('/update/profile',[FrontendController::class,'update_profile'])->name('update.profile');
Route::get('/wish/{product_id}',[FrontendController::class,'wish'])->name('wish');
Route::get('/shop/details',[FrontendController::class,'shop_details'])->name('shop.details');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

//====User=====//
Route::get('/user/list',[UserController::class,'userlist'])->name('user.list');
Route::get('/delete/user/{user_id}',[UserController::class,'delete_user'])->name('delete.user');
Route::get('/edit/profile',[UserController::class,'edit_profile'])->name('edit.profile');
Route::post('/update/name',[UserController::class,'update_name'])->name('update.name');
Route::post('/update/password',[UserController::class,'update_password'])->name('update.password');
Route::post('/add/profile_photo',[UserController::class,'add_profile_photo'])->name('add.photo');

//=====Category=======//
Route::get('/category',[CategoryController::class,'category'])->name('category');
Route::post('/add/category',[CategoryController::class,'add_category'])->name('add.category');
Route::get('/edit/category/{category_id}',[CategoryController::class,'edit_category'])->name('edit.category');
Route::post('/update/category',[CategoryController::class,'update_category'])->name('update.category');
Route::get('/delete/category/{category_id}',[CategoryController::class,'delete_category'])->name('delete.category');


//=====Sub-Category=======//
Route::get('/subcategory',[SubCategoryController::class,'subcategory'])->name('subcategory');
Route::post('/add/subcategory',[SubCategoryController::class,'add_subcategory'])->name('add.subcategory');
Route::get('/delete/subcategory/{subcategory_id}',[SubCategoryController::class,'delete_subcategory'])->name('delete.subcategory');


//=====Product=======//
Route::get('/product',[ProductController::class,'product'])->name('product');
Route::post('/getsubcategory',[ProductController::class,'getsubcategory']);
Route::post('/add/product',[ProductController::class,'add_product'])->name('add.product');
Route::get('/view/product',[ProductController::class,'view_product'])->name('view.product');
Route::get('/delete/product/{product_id}',[ProductController::class,'delete_product'])->name('delete.product');

//=====Color==========//
Route::get('/color/size',[ProductController::class,'color_size'])->name('color.size');
Route::post('/add/color',[ProductController::class,'add_color'])->name('add.color');
Route::get('/delete/color/{color_id}',[ProductController::class,'delete_color'])->name('delete.color');

//=====Size==========//
Route::post('/add/size',[ProductController::class,'add_size'])->name('add.size');
Route::get('/delete/size/{size_id}',[ProductController::class,'delete_size'])->name('delete.size');

//=====Inventory========//
Route::get('/inventory/{product_id}',[ProductController::class,'inventory'])->name('inventory');
Route::post('/add/inventory',[ProductController::class,'add_inventory'])->name('add.inventory');
Route::get('/delete/inventory/{inventory_id}',[ProductController::class,'delete_inventory'])->name('delete.inventory');

//=====Orders====================//
Route::get('/orders',[OrderController::class,'orders'])->name('orders');
Route::post('/orders/status',[OrderController::class,'orders_status'])->name('order.status');


//=====CustomerRegister==========//
Route::get('/customer/register',[CustomerRegisterController::class,'customer_login_register'])->name('customer.login.register');
Route::post('/customer/register',[CustomerRegisterController::class,'customer_register'])->name('customer.register');

//=====CustomerLogin==========//
Route::get('/customer/login/view',[CustomerLoginController::class,'customer_login_view'])->name('customer.login.view');
Route::post('/customer/login',[CustomerLoginController::class,'customer_login'])->name('customer.login');
Route::get('/customer/logout',[CustomerLoginController::class,'customer_logout'])->name('customer.logout');

//=====Cart===============//
Route::post('/add/cart',[CartController::class,'add_cart'])->name('add.cart');
Route::get('/delete/cart/{cart_id}',[CartController::class,'delete_cart'])->name('delete.cart');
Route::get('/view/cart',[CartController::class,'view_cart'])->name('view.cart');
Route::post('/update/cart',[CartController::class,'update_cart'])->name('update.cart');

//=====Coupon===============//
Route::get('/coupon',[CouponController::class,'coupon'])->name('coupon');
Route::post('/add/coupon',[CouponController::class,'add_coupon'])->name('add.coupon');
Route::get('/delete/coupon{coupon_id}',[CouponController::class,'delete_coupon'])->name('delete.coupon');

//=====Checkout===================//
Route::post('/getCity',[CheckoutController::class,'getCity']);
Route::post('/add/orders',[CheckoutController::class,'add_orders'])->name('add.orders');
Route::get('/order/success',[CheckoutController::class,'order_success'])->name('order.success');

// SSLCOMMERZ Start
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);
Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);
Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

//=====CustomerInvoice============//
Route::get('/invoice/download/{order_id}',[CustomerController::class,'invoice_download'])->name('invoice.download');
Route::post('/review',[CustomerController::class,'review'])->name('review');

//=====Password Reset======================//
Route::get('/password/reset',[CustomerController::class,'password_reset'])->name('password.reset.form');
Route::post('/password/reset/send',[CustomerController::class,'pass_reset_send'])->name('pass.reset.send');
Route::get('/password/reset/form/{reset_token}',[CustomerController::class,'pass_res_form'])->name('pass.res.form');
Route::post('/password/input/form',[CustomerController::class,'pass_new_send'])->name('pass.new.send');

//=====Email Verify=================//
Route::get('/verify/email/{verify_token}',[CustomerController::class,'verify_email'])->name('verify.email');

//=======Github======================//
Route::get('/github/provider',[GithubController::class,'redirect_provider']);
Route::get('/github/callback',[GithubController::class,'provider_to_application']);

//=======Google======================//
Route::get('/google/provider',[GoogleController::class,'redirect_provider']);
Route::get('/google/callback',[GoogleController::class,'provider_to_application']);

//=======Google======================//
Route::get('/facebook/provider',[FacebookController::class,'redirect_provider']);
Route::get('/facebook/callback',[FacebookController::class,'provider_to_application']);
