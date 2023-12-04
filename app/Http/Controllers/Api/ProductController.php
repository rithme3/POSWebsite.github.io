<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\product;

class ProductController extends Controller
{
    public function listProduct(Request $request){
        $data= product::join('categories','categories.id','products.category_id')
        ->join('users','users.id','products.create_by_id')
        ->select('products.*',
                  'categories.name as category_name',
                  'users.name as creator'
                  );
        
                if($request->category_id){
                    $category_id = $request->category_id;
                    $data->where(function ($query) use ($category_id) {
                        $query->where('products.category_id', $category_id);
                    });
                }
    
                if($request->keyword){
                    $keyword = $request->keyword;
                    $data->where(function ($query) use ($keyword) {
                        $query->where('title', 'like', "%{$keyword}%");
                        $query->orWhere('users.name', 'like', "%{$keyword}%");
                        $query->orWhere('categories.name', 'like', "%{$keyword}%");
                        $query->orWhere('products.short_description', 'like', "%{$keyword}%");
                        $query->orWhere('products.description', 'like', "%{$keyword}%");
                    });
                }
                
                $data = $data->get();

                return response()->json([
                    'data' => $data,
                    'status' => 200,
                    'sms' => 'sucess'
                ]);
    }

    public function detail(Request $request){
        $data = product::find($request->id);
        $data = $data->get();
        return response()->json([
            'data' => $data,
            'status' => 200,
            'sms' => 'sucess'
        ]);
    }

    public function delete(Request $request){
        $product = product::find($request->id);
        if(!$product){
            return response()->json([
                'data' => null,
                'status' => 500,
                'sms' => 'error'
            ]);
        $product->active = 0;
        }
        if($product->save()){
            return response()->json([
                'data' => null,
                'status' => 200,
                'sms' => 'sucess'
            ]);
        }else{
            return response()->json([
                'data' => null,
                'status' => 500,
                'sms' => 'error'
            ]);
        }
    }
    public function save(Request $request){
        $product=new product;
        $product->name=$request->name; 
        $product->purchase_price=$request->purchase_price; 
        $product->sell_price=$request->sell_price; 
        $product->category_id=$request->category_id; 
        $product->create_by_id=$request->create_by_id; 
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
            return response()->json([
                'data' => null,
                'status' => 200,
                'sms' => 'sucess'
            ]);
        }else{
            return response()->json([
                'data' => null,
                'status' => 200,
                'sms' => 'sucess'
            ]);
        }
    }
    
    public function update(Request $request){
        // dd($request->name);
        $product=product::find($request->id);;
        $product->name=$request->name; 
        $product->purchase_price=$request->purchase_price; 
        $product->sell_price=$request->sell_price; 
        $product->category_id=$request->category_id; 
        $product->create_by_id=$request->create_by_id; 
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
            return response()->json([
                'data' => $product,
                'status' => 200,
                'sms' => 'sucess'
            ]);
        }else{
            return response()->json([
                'data' => null,
                'status' => 500,
                'sms' => 'error'
            ]);
        }
    }
}
