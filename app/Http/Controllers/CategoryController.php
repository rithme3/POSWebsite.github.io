<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use DB;
use Carbon\Carbon;
use DataTables;
class CategoryController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = category::where('active', 1)->orderBy('id','desc');
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                    // $delete = '<a href="'.route('category.delete', $row->id).'">Delete</a>' ;
                    $delete = '<button onclick="removeRow('.$row->id.',this)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>';
                    $edit = '<button onclick="editRow('.$row->id.',this)" class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>';
                    // $edit = '<a href="'.$row->id.'">Edit</a>' ;
                    // $detail = '<a href="'.route('admin.admin_user.detail', $row->id).'">Detail</a>' ;
                    // $btn = $delete .' '. $edit. ' '. $detail;
                    return $edit.' '.$delete;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admins.category.index');

    }

    public function create(){
        return view('admins.category.create');
    }
    public function edit($id){
        $data= category::find($id);
        return response()->json([
            'status' => 200,
            'data' => $data,
            'sms' => 'Edited successfull.'
        ]);
        // return view('admins.category.edit',$data);
    }
    public function save(Request $request){
        // dd($request->file('files'));
        $category=new category;
        $category->name=$request->name;
        $category->files=$request->file;
        // $category->files=$request->file->store('assets/images','custom');
        // if($request->hasFile('file')){
        //     $category->files=$request->file->store('assets/images','custom');
            // $file=$request->file('thumbnail');
            // $name= auth()->article()->id.'_'.strtotime("now").'_'.rand(1,9999).'.jpg';
            // $destinationPath='assets/images/'.$name;
            // $file->move('assets/images',$destinationPath);
            // $article->thumbnail=$destinationPath;
        // } 
        if($category->save()){
            return response()->json([
                'status' => 200,
                'data' => $category,
                'sms' => 'Data saved successfull.'
            ]);
            // return redirect()->route('category.index')->with('success','category created successfuly!');
        }else{
            return response()->json([
                'status' => 500,
                'data' => null,
                'sms' => 'Data not saved!'
            ]);
            // return redirect()->route('category.index')->with('error','Can not create! Try again.');
        }
    }
    public function update(Request $request){
        // dd($request->name);
        $category=category::find($request->id);
        $category->name=$request->name;
        // $category->active=$request->active; 
        if($category->save()){
            return response()->json([
                'status' => 200,
                'data' => $category,
                'sms' => 'Updated successfull.'
            ]);
            // return redirect()->route('category.index')->with('success','category updated successfuly!');
        }else{
            return response()->json([
                'status' => 500,
                'data' => null,
                'sms' => 'Data not saved!'
            ]);
            // return redirect()->back()->with('error','Can not update! Try again.');
        }
    }
    public function delete($id){
        category::where('id',$id)->delete();   
        // return redirect()->back()->with('success','category deleted successfuly!');
        return response()->json([
            'status' => 200,
            'data' => null,
            'sms' => 'category deleted successfuly!'
        ]);
    }
}

