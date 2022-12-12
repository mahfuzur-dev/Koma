<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\Country;
use App\Models\CustomerLogin;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Size;
use App\Models\Thumbnail;
use App\Models\Wish;
use Carbon\Carbon;
use Faker\Provider\Image as ProviderImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;

class FrontendController extends Controller
{
    function frontend(){
        $all_categories = Category::all();
        $all_products = Product::all();
        $new_arrivals = Product::latest()->take(3)->get();
        $best_sellings = OrderProduct::groupBy('product_id')
        ->selectRaw('sum(quantity) as sum, product_id')->take(3)
        ->orderBy('quantity','DESC')
        ->havingRaw('sum >= 2')
        ->get();
        $get_recent_view = json_decode(Cookie::get('recent_view', true));
        if($get_recent_view == null){
            $get_recent = [];
            $after_unique = array_unique($get_recent);
        }
        else{
            $after_unique = array_unique($get_recent_view);
        }
        $all_recent_product = Product::find($after_unique)->take(3);
        return view('frontend.index',[
            'all_categories'=>$all_categories,
            'all_products'=>$all_products,
            'new_arrivals'=>$new_arrivals,
            'best_sellings'=>$best_sellings,
            'all_recent_product'=>$all_recent_product,
            
        ]);
    }
    function product_details($product_slug){
        $product_info = Product::where('slug',$product_slug)->get();
        $thumbnails = Thumbnail::where('product_id',$product_info->first()->id)->get();
        $available_colors = Inventory::where('product_id',$product_info->first()->id)->groupBy('color_id')->selectRaw('sum(color_id) as sum,color_id')->get();
        $order_products = OrderProduct::where('product_id',$product_info->first()->id)->whereNotNull('review')->get();
        $total_review = OrderProduct::where('product_id',$product_info->first()->id)->whereNotNull('review')->count();
        $total_star = OrderProduct::where('product_id',$product_info->first()->id)->whereNotNull('review')->sum('star');
        $product_id = $product_info->first()->id;
        $all = Cookie::get('recent_view');
        if(!$all){
            $all = '[]';
        }
        $all_info = json_decode($all, true);
        $all_info = Arr::prepend($all_info,$product_id);
        $recent_viewed_id = json_encode($all_info);
        Cookie::queue('recent_view', $recent_viewed_id , 1000);
        return view('frontend.product_details',[
            'product_info'=>$product_info,
            'thumbnails'=>$thumbnails,
            'available_colors'=>$available_colors,
            'order_products'=>$order_products,
            'total_review'=>$total_review,
            'total_star'=>$total_star,
        ]);
    }
    function getsize(Request $request){
        $str = '<option value="" class="color_id" data-col="'.$request->color_id.'">---Select Size---</option>';
        $sizes = Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();
        foreach($sizes as $size){
            $str.= '<option value="'.$size->size_id.'">'.$size->rel_to_size->size_name.'</option>';
        }
        echo $str;
    }
    function getStock(Request $request){
        $quantity = Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->first()->quantity;
        if($quantity == 0){
            echo '<button type="button"  id="cart" class="btn btn-warning"> Out Of Stock </button>'; 
        }
        else{
            echo '<p>Stock : '.$quantity.'</p>
            <button type="submit" class="btn btn-dark"><i class="lni lni-shopping-basket mr-2"></i>Add to Cart </button>';
        }
    }
    function checkout(){
        $all_countries = Country::all();
        $all_carts = Cart::where('customer_id',Auth::guard('customerlogin')->id())->get();
        $all_carts_count = Cart::where('customer_id',Auth::guard('customerlogin')->id())->count();
        return view('frontend.checkout',[
            'all_countries'=>$all_countries,
            'all_carts'=>$all_carts,
            'all_carts_count'=>$all_carts_count,
        ]);
    }
    function account(){
        $orders = Order::where('customer_id',Auth::guard('customerlogin')->id())->get();
        $order_product = OrderProduct::where('customer_id',Auth::guard('customerlogin')->id())->get();
        $order_product_total = OrderProduct::groupBy('customer_id')->selectRaw('sum(price) as sum, customer_id')->get();
        return view('frontend.account',[
            'orders'=>$orders,
            'order_product'=>$order_product,
            'order_product_total'=>$order_product_total,
        ]);
    }
    function profile_info(){
        return view('frontend.profile_info');
    }
    function update_profile(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
        ]);
        if($request->old_password == ''&& $request->profile_photo == ''){
            CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                'name'=>$request->name,
                'email'=>$request->email,
            ]);
        }
        elseif($request->profile_photo == ''){
            if(Hash::check($request->old_password, Auth::guard('customerlogin')->user()->password)){
                CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                'password'=>bcrypt($request->password),
                ]);
            }
            else{
                 return back()->with('wrong', 'Old password Doesnot Match');
            }
        }
        else{
            $profile_photo = $request->profile_photo;
            if(Auth::guard('customerlogin')->user()->profile_photo != null){
                $extension = $profile_photo->getClientOriginalExtension();
                $file_name = Auth::guard('customerlogin')->user()->id.'.'.$extension;
                $img = Image::make($profile_photo)->save(public_path('uploads/customer/profile/'.$file_name));
                CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                    'profile_photo'=>$file_name,
                ]);
                return back()->with('profile_success', 'Profile Photo Successfully Updated!');
            }
            else{
                $extension = $profile_photo->getClientOriginalExtension();
                $file_name = Auth::guard('customerlogin')->user()->id.'.'.$extension;
                $img = Image::make($profile_photo)->save(public_path('uploads/customer/profile/'.$file_name));
                CustomerLogin::find(Auth::guard('customerlogin')->id())->update([
                    'profile_photo'=>$file_name,
                ]);
                return back()->with('profile_success', 'Profile Photo Successfully Updated!');
            }
        }
        return back();
    }
    function wish($product_id){
        $wish = Wish::where('customer_id',Auth::guard('customerlogin')->user()->id)->where('product_id',$product_id)->first();
        if($wish == ''){
            Wish::insert([
                'customer_id'=>Auth::guard('customerlogin')->user()->id,
                'product_id'=>$product_id,
                'created_at'=>Carbon::now(),
            ]);
            return redirect()->route('frontend');
        }
        else{
            return redirect()->route('frontend');
        }
    }
    function wish_info(){
        $all_wishes = Wish::where('customer_id',Auth::guard('customerlogin')->user()->id)->get();
        return view('frontend.wist_info',[
            'all_wishes'=>$all_wishes,
        ]);
    }
    function wish_delete($wish_id){
        Wish::find($wish_id)->delete();
        return back();
    }
    function shop_details(Request $request){
        $data = $request->all();
        $term = 'created_at';
        $order = 'DESC';
        if(!empty($data['sort']) && $data['sort'] != '' && $data['sort'] != 'undefined'){
            if($data['sort'] == 1){
                $term = 'product_name';
                $order = 'ASC';
            }
            else if($data['sort'] == 2){
                $term = 'product_name';
                $order = 'DESC';
            }
            else if($data['sort'] == 3){
                $term = 'after_discount';
                $order = 'DESC';
            }
            else if($data['sort'] == 4){
                $term = 'after_discount';
                $order = 'ASC';
            }
            else{
                $term = 'created_at';
                $order = 'DESC';
            }
        }
        $all_products = Product::where(function ($q) use ($data){
            if(!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined'){
                $q->where(function ($q) use ($data){
                    $q->where('product_name','like', '%'.$data['q'].'%');
                    $q->orWhere('long_desp','like', '%'.$data['q'].'%');
                    $q->orWhere('short_desp','like', '%'.$data['q'].'%');
                    $q->orWhere('product_brand','like', '%'.$data['q'].'%');
                });
            }
            if(!empty($data['category_id']) && $data['category_id'] != '' && $data['category_id'] != 'undefined'){
                $q->where('category_id', $data['category_id']);
            }
            if(!empty($data['min']) && $data['min'] != '' && $data['min'] != 'undefined' || !empty($data['max']) && $data['max'] != '' && $data['max'] != 'undefined'){
                $q->whereBetween('after_discount', [$data['min'], $data['max']]);
            }
            if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined' || !empty($data['size_id']) && $data['size_id'] != '' && $data['size_id'] != 'undefined'){
                $q->whereHas('rel_to_inventory', function ($q) use ($data){
                    if(!empty($data['color_id']) && $data['color_id'] != '' && $data['color_id'] != 'undefined'){
                        $q->whereHas('rel_to_color', function ($q) use ($data){
                            $q->where('colors.id', $data['color_id']);
                        });
                        $q->whereHas('rel_to_size', function ($q) use ($data){
                            $q->where('sizes.id', $data['size_id']);
                        });
                    }
                });
            }
        })->orderBy($term,$order)->get();
        $all_categories = Category::all();
        $all_colors = Color::all();
        $all_sizes = Size::all();
        return view('frontend.shop_details',[
            'all_products'=>$all_products,
            'all_categories'=>$all_categories,
            'all_colors'=>$all_colors,
            'all_sizes'=>$all_sizes,
        ]);
    }
    
}
