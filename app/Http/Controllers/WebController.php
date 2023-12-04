<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Product;
use App\Models\users;
use DB;
use App;

class WebController extends Controller
{
    public function home(Request $request){
        
        $products = DB::table('products')->where('active', 1)
        ->paginate(8);
        if($request->keyword){
            $keyword = $request->keyword;
            $products->where(function ($query) use ($keyword) {
                $query->where('name', 'like', "%{$keyword}%");
                $query->orWhere('categories.name', 'like', "%{$keyword}%");
                $query->orWhere('products.description', 'like', "%{$keyword}%");

            });
        }
        $data['products'] = $products;
        return view('website.index', $data);
    }

    public function detail(Request $request, $id){
        $data['product'] = product::find($id);
        return view('website.product_detail', $data);
    }

    public function productByCategory(Request $request, $name, $id){
        $data['products'] = product::
            where('active', 1)
            ->where('category_id', $id)
            ->paginate(4);
        $data['name'] = $name;
        return view('website.product_by_category', $data);
    }

    public function switchLanguage($locale){
        App::setlocale($locale);
        session()->put('locale',$locale);
        return redirect()->back(); 
    }
}
