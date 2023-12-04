@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('category.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>Edit category</h3>
                <form action="{{route('category.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$categories->id}}">
                <div class="form-grop">
                    <table>Name <span class="text-danger">*</span></table>
                    <input type="text" name="name" value="{{$categories->name}}" class="form-control" required>
                <div class="form-grop">
                    <table>Status <span class="text-danger">*</span></table>
                    <select name="active" id="active">
                        <option value="1" @if($categories->active==1) selected @endif >Active</option>
                        <option value="0" @if($categories->active==0) selected @endif >Deleted</option>
                    </select>
                </div>
                <button class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection