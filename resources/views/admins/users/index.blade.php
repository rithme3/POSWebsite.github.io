@extends('layouts.master')

@section('content')
<div class="row d-md-none d-block">
    <div class="col-sm-12">
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('users.create')}}" class="btn btn-primary">Create</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>List of users</h3>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
                @endif
                <div class="table-responsive">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $k => $user)
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>
                                    @if($user->photo)
                                    <img src="{{asset($user->photo)}}" alt="" class="rounded-circle" width="40px" height="40px">
                                    @else
                                    <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" alt="Profile" class="rounded-circle" width="50px">
                                    @endif
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->user_type}}</td>
                                <td>
                                    @if($user->active)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Deleted</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('users.delete',$user->id)}}" onclick="return confirm('Are you want to delete?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    
            </div>
        </div>
    </div>
</div>

<div class="row d-none d-md-block">
    <div class="col-sm-12">
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('users.create')}}" class="btn btn-primary">Create</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>List of users</h3>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Photo</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Type</td>
                            <td>Status</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $k => $user)
                        <tr>
                            <td>{{$k+1}}</td>
                            <td>
                                @if($user->photo)
                                <img src="{{asset($user->photo)}}" alt="Profile" class="rounded-circle" width="50px" height="50px">
                                @else
                                <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" alt="Profile" class="rounded-circle" width="50px">
                                @endif
                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->user_type}}</td>
                            <td>
                                @if($user->active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Deleted</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('users.edit',$user->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="{{route('users.delete',$user->id)}}" onclick="return confirm('Are you want to delete?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection