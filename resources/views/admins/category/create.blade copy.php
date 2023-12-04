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
                <h3>Create new category</h3>
                <form action="{{route('category.save')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="form-grop">
                    <table>Category name <span class="text-denger">*</span></table>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <button class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection