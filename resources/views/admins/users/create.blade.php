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
                <h3>Create new user</h3>
                <form action="{{route('users.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="form-grop">
                    <table>Name <span class="text-denger">*</span></table>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-grop">
                    <table>Email <span class="text-denger">*</span></table>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-grop">
                    <table>Password <span class="text-denger">*</span></table>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-grop">
                    <table>Photo <span class="text-denger">*</span></table>
                    <input type="file" name="photo" class="form-control">
                </div>
                <button class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection