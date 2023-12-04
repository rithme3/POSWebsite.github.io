<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\article;
use App\Models\users;
use DB;
use Carbon\Carbon;
class ArticleController extends Controller
{
    public function index(Request $request){
        $article= article::join('categories','categories.id','articles.category_id')
        ->join('users','users.id','articles.create_by_id')
        ->select('articles.*',
                  'categories.name as category_name',
                  'users.name as creator'
                  );
        
                if($request->category_id){
                    $category_id = $request->category_id;
                    $article->where(function ($query) use ($category_id) {
                        $query->where('articles.category_id', $category_id);
                    });
                }
    
                if($request->keyword){
                    $keyword = $request->keyword;
                    $article->where(function ($query) use ($keyword) {
                        $query->where('title', 'like', "%{$keyword}%");
                        $query->orWhere('users.name', 'like', "%{$keyword}%");
                        $query->orWhere('categories.name', 'like', "%{$keyword}%");
                        $query->orWhere('articles.short_description', 'like', "%{$keyword}%");
                        $query->orWhere('articles.description', 'like', "%{$keyword}%");
                    });
                }
            $article = $article->paginate(5);
            $data['articles'] = $article;
            $data['categories'] = Category::where('active', 1)->get();        
        // $data['users']= DB::table['users']->get();
        return view('admins.articles.index',$data);
    }

    public function create(){
        $data['categories']= category::where('active',1)->get();
        $data1['users']= users::where('active',1)->get();
        return view('admins.articles.create',$data,$data1);
    }
    public function edit($id){
        $data['articles']= article::find($id);
        $data['categories']=category::where('active',1)->get();
        $data['users']=users::where('active',1)->get();

        return view('admins.articles.edit',$data);
    }
    public function save(Request $request){
        $article=new article;
        $article->title=$request->title; 
        $article->category_id=$request->category_id; 
        $article->create_by_id=$request->create_by_id; 
        $article->short_description=$request->short_description; 
        $article->description=$request->description; 
        if($request->hasFile('thumbnail')){
            $article->thumbnail=$request->file('thumbnail')->store('assets/images','custom');
            // $file=$request->file('thumbnail');
            // $name= auth()->article()->id.'_'.strtotime("now").'_'.rand(1,9999).'.jpg';
            // $destinationPath='assets/images/'.$name;
            // $file->move('assets/images',$destinationPath);
            // $article->thumbnail=$destinationPath;
        } 
        if($article->save()){
            return redirect()->route('article.index')->with('success','article created successfuly!');
        }else{
            return redirect()->route('article.index')->with('error','Can not create! Try again.');
        }
    }
    public function update(Request $request){
        // dd($request->name);
        $article=article::find($request->id);;
        $article->title=$request->title; 
        $article->category_id=$request->category_id; 
        $article->create_by_id=$request->create_by_id; 
        $article->short_description=$request->short_description; 
        $article->description=$request->description; 
        $article->is_publish=$request->is_publish;
        $article->active=$request->active; 
        if($request->is_publish && $article->publish_date == NULL){
            $article->publish_date = Carbon::now()->format('Y-m-d');
        }
        if($request->hasFile('thumbnail')){
            $article->thumbnail=$request->file('thumbnail')->store('assets/images','custom');
            // $file=$request->file('thumbnail');
            // $name= auth()->article()->id.'_'.strtotime("now").'_'.rand(1,9999).'.jpg';
            // $destinationPath='assets/images/'.$name;
            // $file->move('assets/images',$destinationPath);
            // $article->thumbnail=$destinationPath;
        } 
        if($article->save()){
            return redirect()->route('article.index')->with('success','article created successfuly!');
        }else{
            return redirect()->route('article.index')->with('error','Can not create! Try again.');
        }
    }
    public function delete($id){
        $article=article::find($id);
        $article->active=0;
        if($article->save()){
            return redirect()->back()->with('success','active deleted successfuly!');
        }else{
            return redirect()->route('category.index')->with('error','Can not delete! Try again.');
        }
    }
}

