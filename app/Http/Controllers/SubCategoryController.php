<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    function subcategory(){
        $all_categories = Category::all();
        $all_subcategories = SubCategory::all();
        return view('admin.subcategory.index',[
            'all_categories'=>$all_categories,
            'all_subcategories'=>$all_subcategories,
        ]);
    }
    function add_subcategory(Request $request){
        $request->validate([
            'category_id'=>'required',
        ]);
        if(Subcategory::where('category_id',$request->category_id)->where('subcategory_name',$request->subcategory_name)->exists()){
            return back()->with('exist','Sub Category Name already taken in this Category');
        }
        else{
            SubCategory::insert([
            'category_id'=>$request->category_id,
            'subcategory_name'=>$request->subcategory_name,
            'created_at'=>Carbon::now(),
            ]);
            return back()->with('subcategory_success','Sub-Category Added!');
        }
    }
    function delete_subcategory($subcategory_id){
        SubCategory::find($subcategory_id)->delete();
        return back()->with('delete_subcategory','SubCategory Deleted!');
    }
    
}
