<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use App\Models\users;
use DB;
use Carbon\Carbon;
class ProductController extends Controller
{
    public function index(Request $request){
        $product= product::join('categories','categories.id','products.category_id')
        ->join('users','users.id','products.created_by_id')
        ->select('products.*',
                  'categories.name as category_name',
                  'users.name as creator'
                  );
        
                if($request->category_id){
                    $category_id = $request->category_id;
                    $product->where(function ($query) use ($category_id) {
                        $query->where('products.category_id', $category_id);
                    });
                }
    
                if($request->keyword){
                    $keyword = $request->keyword;
                    $product->where(function ($query) use ($keyword) {
                        // $query->where('products.title', 'like', "%{$keyword}%");
                        $query->orWhere('users.name', 'like', "%{$keyword}%");
                        $query->orWhere('categories.name', 'like', "%{$keyword}%");
                        $query->orWhere('products.name', 'like', "%{$keyword}%");
                        $query->orWhere('products.description', 'like', "%{$keyword}%");
                    });
                }
            $product = $product->paginate(5);
            $data['products'] = $product;
            $data['categories'] = Category::where('active', 1)->get();        
        // $data['users']= DB::table['users']->get();
        return view('admins.products.index',$data);
    }

    public function create(){
        $data['categories']= category::where('active',1)->get();
        $data1['users']= users::where('active',1)->get();
        return view('admins.products.create',$data,$data1);
    }
    public function edit($id){
        $data['products']= product::find($id);
        $data['categories']=category::where('active',1)->get();
        $data['users']=users::where('active',1)->get();

        return view('admins.products.edit',$data);
    }
    public function save(Request $request){
        $product=new product;
        $product->name=$request->name; 
        $product->purchase_price=$request->purchase_price; 
        $product->sell_price=$request->sell_price; 
        $product->category_id=$request->category_id; 
        $product->created_by_id=$request->created_by_id; 
        $product->description=$request->description;  
        if($request->hasFile('thumbnail')){
            $product->thumbnail=$request->file('thumbnail')->store('assets/images','custom');
            // $file=$request->file('thumbnail');
            // $name= auth()->article()->id.'_'.strtotime("now").'_'.rand(1,9999).'.jpg';
            // $destinationPath='assets/images/'.$name;
            // $file->move('assets/images',$destinationPath);
            // $article->thumbnail=$destinationPath;
        } 
        if($product->save()){
            return redirect()->route('product.index')->with('success','Product created successfuly!');
        }else{
            return redirect()->route('product.index')->with('error','Can not create! Try again.');
        }
    }
    public function update(Request $request){
        // dd($request->name);
        $product=product::find($request->id);;
        $product->name=$request->name; 
        $product->purchase_price=$request->purchase_price; 
        $product->sell_price=$request->sell_price; 
        $product->category_id=$request->category_id; 
        $product->created_by_id=$request->created_by_id; 
        $product->description=$request->description; 
        $product->active=$request->active; 
        if($request->hasFile('thumbnail')){
            $product->thumbnail=$request->file('thumbnail')->store('assets/images','custom');
            // $file=$request->file('thumbnail');
            // $name= auth()->article()->id.'_'.strtotime("now").'_'.rand(1,9999).'.jpg';
            // $destinationPath='assets/images/'.$name;
            // $file->move('assets/images',$destinationPath);
            // $article->thumbnail=$destinationPath;
        } 
        if($product->save()){
            return redirect()->route('product.index')->with('success','Product updated successfuly!');
        }else{
            return redirect()->route('product.index')->with('error','Can not update! Try again.');
        }
    }
    public function delete($id){
        $product=product::find($id);
        $product->active=0;
        if($product->save()){
            return redirect()->back()->with('success','active deleted successfuly!');
        }else{
            return redirect()->route('product.index')->with('error','Can not delete! Try again.');
        }
    }
}

