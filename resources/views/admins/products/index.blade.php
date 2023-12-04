@extends('layouts.master')

@section('content')
<div class="row d-md-none d-block">
    <div class="col-sm-12">
       
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('product.create')}}" class="btn btn-sm btn-primary"> <i class="fa fa-plus-circle"></i> Create</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5>List of product</h5>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
                @endif

                <form class="row" method="get">
                    <div class="col-4 form-group">
                        <label for="">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">----</option>
                            @foreach($categories as $categ)
                            <option  value="{{$categ->id}}">{{$categ->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 form-group">
                        <label for="">Keyword</label>
                        <input type="text" name="keyword"  class="form-control" placeholder="Search by title, category name, creator name, description...">
                    </div>
                    <div class="col-xs form-group">
                        <label for=""><br><br></label>
                        <button class="btn btn-primary mt-4"><i class="fa fa-search"></i></button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th >No.</th>
                                <th >Thumbnail</th>
                                <th >Name</th>
                                <th >Purchase_Price</th>
                                <th >Sell_Price</th>
                                <th >Description</th>
                                <th >Category</th>
                                <th >Created_By</th>
                                <th >Status</th>
                                <th >Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $k => $product)
                            <tr>
                                <td style="font-size: 12px;">{{$products->firstItem() + $k}}</td>
                                <td style="font-size: 12px;">
                                    <img src="{{asset($product->thumbnail)}}" alt="Thumbnail" width="50px" >
                                </td>
                                <td style="font-size: 12px;">{{$product->name}}</td>
                                <td style="font-size: 12px;">{{$product->purchase_price}}</td>
                                <td style="font-size: 12px;">{{$product->sell_price}}</td>
                                <td style="font-size: 12px;">{{$product->description}}</td>
                                <td style="font-size: 12px;">{{$product->category_name}}</td>
                                <td style="font-size: 12px;">{{$product->creator}}</td>
                                <td style="font-size: 12px;">
                                    @if($product->active)
                                    <span class="badge badge-success">Active</span>
                                    @else
                                    <span class="badge badge-danger">Deleted</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('product.edit', $product->id)}}" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                    <a href="{{route('product.delete', $product->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                    {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row d-none d-md-block">
    <div class="col-sm-12">
       
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('product.create')}}" class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Create</a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h3>List of product</h3>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
                @endif

                <form class="row" method="get">
                    <div class="col-sm-3 form-group">
                        <label for="">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">----</option>
                            @foreach($categories as $categ)
                            <option value="{{$categ->id}}">{{$categ->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="">Keyword</label>
                        <input type="text" name="keyword" class="form-control" placeholder="Search by title, category name, creator name, description...">
                    </div>
                    <div class="col-sm form-group">
                        <label for=""><br><br></label>
                        <button class="btn btn-primary mt-4"><i class="fa fa-search"></i> Search</button>
                    </div>
                </form>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Thumbnail</td>
                            <td>Name</td>
                            <td>Purchase Price</td>
                            <td>Sell Price</td>
                            <td>Description</td>
                            <td>Category</td>
                            <td>Created By</td>
                            <td>Status</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $k => $product)
                        <tr>
                            <td>{{$products->firstItem() + $k}}</td>
                            <td>
                                <img src="{{asset($product->thumbnail)}}" alt="Thumbnail" width="40px" >
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->purchase_price}}</td>
                            <td>{{$product->sell_price}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->category_name}}</td>
                            <td>{{$product->creator}}</td>
                            <td>
                                @if($product->active)
                                <span class="badge badge-success">Active</span>
                                @else
                                <span class="badge badge-danger">Deleted</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{route('product.edit', $product->id)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="{{route('product.delete', $product->id)}}" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12">
                    {{$products->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection