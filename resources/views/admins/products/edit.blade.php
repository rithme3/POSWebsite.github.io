@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('product.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>Edit product</h3>
                <form action="{{route('product.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$products->id}}">
                    <div class="form-grop">
                        <table>Name <span class="text-danger">*</span></table>
                        <input type="text" name="name" value="{{$products->name}}" class="form-control" required>
                    </div>
                    <div class="form-grop">
                        <table>Purchase Price <span class="text-danger">*</span></table>
                        <input type="number" step="0.01" name="purchase_price" value="{{$products->purchase_price}}" class="form-control" required>
                    </div>
                    <div class="form-grop">
                        <table>Sell Price <span class="text-danger">*</span></table>
                        <input type="number" step="0.01" name="sell_price" value="{{$products->sell_price}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category id <span class="text-danger">*</span></label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select a category</option>
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}" @if($products->category_id == $cat->id) selected @endif>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="created_by_id">created_by_id <span class="text-danger">*</span></label>
                        <select name="created_by_id" id="created_by_id" class="form-control">
                            <option value="">User who create this product</option>
                            @foreach($users as $user)
                                <option value="{{$user->id}}" @if($products->created_by_id == $user->id) selected @endif>{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Long Description <span class="text-danger">*</span></label>
                        <textarea name="description" value="" id="description" rows="10" class="form-control" required>{{$products->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail <span class="text-danger">*</span></label>
                        <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                    </div>
                    <div class="form-grop">
                        <table>Status <span class="text-danger">*</span></table>
                        <select name="active" id="active">
                            <option value="1" @if($products->active==1) selected @endif >Active</option>
                            <option value="0" @if($products->active==0) selected @endif >Deleted</option>
                        </select>
                    </div>         
                    <button class="btn btn-primary mt-3">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-js')
    <script>
        $(document).ready(function() {
            $('#description').summernote();
        });
    </script>
@endsection