<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Size;
use App\Models\SubCategory;
use App\Models\Thumbnail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    function product(){
        $all_categories = Category::all();
        $all_subcategories = SubCategory::all();
        return view('admin.product.index',[
            'all_categories'=>$all_categories,
            'all_subcategories'=>$all_subcategories,
        ]);
    }
    function getsubcategory(Request $request){
        $subcategories = SubCategory::where('category_id',$request->category_id)->get();
        $str = '<option value="">--Select Categroy--</option>';
        foreach($subcategories as $subcategory){
            $str .= "<option value='$subcategory->id'>$subcategory->subcategory_name</option>";
        }
        echo $str;
    }
    function add_product(Request $request){
        $request->validate([
            'category_id'=>'required',
            'subcategory_id'=>'required',
            'product_name'=>'required',
            'product_price'=>'required',
            'short_desp'=>'required',
            'preview'=>'required',
        ]);
        $product_name = str_replace('','-',$request->product_name);
        $slug = str::lower($product_name).'-'.random_int(1000000,99999999);
        $product_id = Product::insertGetId([
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'product_name'=>$request->product_name,
            'product_price'=>$request->product_price,
            'product_brand'=>$request->product_brand,
            'discount'=>$request->discount,
            'after_discount'=>$request->product_price -($request->product_price*$request->discount/100),
            'short_desp'=>$request->short_desp,
            'long_desp'=>$request->long_desp,
            'slug'=>$slug,
            'created_at'=>Carbon::now(),
        ]);
        $preview = $request->preview;
        $extension = $preview->getClientOriginalExtension();
        $file_name = str::lower($product_name).'-'.random_int(10000,999999).'.'.$extension;
        Image::make($preview)->resize(680,680)->save(public_path('uploads/preview/'.$file_name));
        Product::find($product_id)->update([
            'preview'=>$file_name,
        ]);
        $thumbnails = $request->thumbnail;
        foreach($thumbnails as $thumbnail){
            $thumbnail_extension = $thumbnail->getClientOriginalExtension();
            $thumbnail_name = str::lower($product_name).'-'.random_int(100,999).'.'.$thumbnail_extension;
            Image::make($thumbnail)->save(public_path('uploads/thumbnail/'.$thumbnail_name));
            Thumbnail::insert([
                'product_id'=>$product_id,
                'thumbnail'=>$thumbnail_name,
                'created_at'=>Carbon::now(),
            ]);
        }
        return back()->with('product_success','Product Added!');
    }
    function view_product(){
        $all_products = Product::all();
        return view('admin.product.view_product',[
            'all_products'=>$all_products,
        ]);
    }
    function delete_product($product_id){
        $preview = Product::find($product_id);
        $delete_preview = public_path('uploads/preview/'.$preview->preview);
        unlink($delete_preview);
        Product::find($product_id)->delete();
        return back()->with('delete_product','Product Deleted!');
    }
    function color_size(){
        $all_colors = Color::all();
        $all_sizes = Size::all();
        return view('admin.color_size.index',[
            'all_colors'=>$all_colors,
            'all_sizes'=>$all_sizes,
        ]);
    }
    function add_color(Request $request){
        $request->validate([
            'color_name'=>'required',
            'color_code'=>'required',
        ]);
        Color::insert([
            'color_name'=>$request->color_name,
            'color_code'=>$request->color_code,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('color_success','Color Successfully Added!');
    }
    function delete_color($color_id){
        Color::find($color_id)->delete();
        return back()->with('color_del','Color Deleted!');
    }
    function add_size(Request $request){
        $request->validate([
            'size_name'=>'required',
        ]);
        Size::insert([
            'size_name'=>$request->size_name,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('size_success','Size Successfully Added!');
    }
    function delete_size($size_id){
        Size::find($size_id)->delete();
        return back()->with('size_del','Size Deleted!');
    }
    function inventory($product_id){
        $product_info = Product::find($product_id);
        $colors = Color::all();
        $sizes = Size::all();
        $inventories = Inventory::where('product_id',$product_id)->get();
        return view('admin.product.inventory',[
            'product_info'=>$product_info,
            'colors'=>$colors,
            'sizes'=>$sizes,
            'inventories'=>$inventories,
        ]);
    }
    function add_inventory(Request $request){
        $request->validate([
            'color_id'=>'required',
            'size_id'=>'required',
            'quantity'=>'required',
        ]);
        if(Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->exists()){
            Inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->where('quantity',$request->quantity)->increment('quantity',$request->quantity);
            return back()->with('inventory_success','Inventory Successfully Added!');
        }
        else{
            Inventory::insert([
                'product_id'=>$request->product_id,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
                'quantity'=>$request->quantity,
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('inventory_success','Inventory Successfully Added!');
        }
    }
    function delete_inventory($inventory_id){
        Inventory::find($inventory_id)->delete();
        return back()->with('delete_inventory','Inventory Deleted!');
    }
}
