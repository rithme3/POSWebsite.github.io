<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\users;
use DB;
class UsersController extends Controller
{
    public function index(){
        $data['users']= users::
        join('user_types', 'user_types.id', 'users.user_type_id')
            ->select(
                'users.*',
                'user_types.name as user_type'
            )
        ->get();
        // $data['users']= DB::table['users']->get();
        return view('admins.users.index',$data);
    }

    public function create(){
        return view('admins.users.create');
    }
    public function edit($id){
        $data['user']= users::find($id);
        return view('admins.users.edit',$data);
    }
    public function save(Request $request){
        $user=new users;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        if($request->hasFile('photo')){
            // $user->photo=$request->file('photo')->store('assets/images','custom');
            $file=$request->file('photo');
            $name= auth()->user()->id.'_'.strtotime("now").'_'.rand(1,9999).'.jpg';
            $destinationPath='assets/images/'.$name;
            $file->move('assets/images',$destinationPath);
            $user->photo=$destinationPath;
        }   
        if($user->save()){
            return redirect()->route('users.index')->with('success','user created successfuly!');
        }else{
            return redirect()->route('users.index')->with('error','Can not create! Try again.');
        }
    }
    public function update(Request $request){
        // dd($request->name);
        $user=users::find($request->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->active=$request->active;
        if($request->password){
            $user->password=bcrypt($request->password);
        }
        if($request->hasFile('photo')){
            // $user->photo=$request->file('photo')->store('assets/images','custom');
            $file=$request->file('photo');
            $name= auth()->user()->id.'_'.strtotime("now").'_'.rand(1,9999).'.jpg';
            $destinationPath='assets/images/'.$name;
            $file->move('assets/images',$destinationPath);
            $user->photo=$destinationPath;
        }   
        if($user->save()){
            return redirect()->route('users.index')->with('success','user updated successfuly!');
        }else{
            return redirect()->back()->with('error','Can not update! Try again.');
        }
    }
    public function delete($id){
        $user=users::find($id);
        $user->active=0;
        if($user->save()){
            return redirect()->back()->with('success','user deleted successfuly!');
        }else{
            return redirect()->route('users.index')->with('error','Can not delete! Try again.');
        }
    }
}

