<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\product;
use App\Models\users;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['user_count']=users::where('active',1)->count();
        $data['product_count']=product::where('active',1)->count();
        $data['product_in_categories']=category::leftjoin('products','products.category_id','categories.id')
        ->select('categories.name as category_name',
        DB::raw('count(products.id) as total_product')
        )->groupBy('categories.id')
        ->orderBy('total_product')
        ->get();
        return view('home',$data);
    }
}
