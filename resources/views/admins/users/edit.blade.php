@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('users.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>Edit user</h3>
                <form action="{{route('users.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                <div class="form-grop">
                    <table>Name <span class="text-danger">*</span></table>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control" required>
                </div>
                <div class="form-grop">
                    <table>Email <span class="text-danger">*</span></table>
                    <input type="email" name="email" value="{{$user->email}}" class="form-control" required>
                </div>
                <div class="form-grop">
                    <table>Password <span class="text-danger">*</span></table>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-grop">
                    <table>Status <span class="text-danger">*</span></table>
                    <select name="active" id="active">
                        <option value="1" @if($user->active==1) selected @endif >Active</option>
                        <option value="0" @if($user->active==0) selected @endif >Deleted</option>
                    </select>
                </div>
                <div class="form-grop">
                    <table>Photo <span class="text-danger">*</span></table>
                    <input type="file" name="photo" class="form-control">
                    <img src="{{asset('$user->photo')}}" alt="Profile" width="100px">
                </div>
                <button class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection