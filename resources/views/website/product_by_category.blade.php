@extends('layouts.webs.master')
@section('content')
    <div class="d-md-none d-block">
        <div class="row mt-3">
            <div class="col-sm-12">
                <h3 class="text-white bg-warning p-1 rounded">
                    {{$name}}
                </h3>
            </div>
        </div>
        <!-- all article  -->
        
        @if(count($products))
        <div class="row mt-3">
            @foreach($products as $pro)
            <div class="col-4 mb-5 p-2">
                <div class="card w-100 mb-1 " style="">
                    <div style="height: 90px">
                    <img src="{{asset($pro->thumbnail)}}" style="height: px" class="card-img-top h-100" alt="Product Thumbnail">
                    </div>
                    <div class="card-body p-1 ps-2" style="height: 40px">
                        <p class="card-title mb-1" style="font-size: 10px;">{{$pro->name}}</p>
                        <p class="card-text mb-2" style="font-size: 10px;"><i>Price: {{$pro->sell_price}}$</i></p>
                        <a href="{{route('product_detail', $pro->id)}}" class="btn btn-primary ms-2" style="font-size: 10px;">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-sm-12">
                {{$products->links()}}
            </div>
        </div>
        @else 
        <div class="row">
            <div class="col">
                <h5 class="text-danger text-center">There is no record...</h5>
            </div>
        </div>
        @endif
    </div>

    <div class="d-none d-md-block">
        <div class="row mt-3">
            <div class="col-sm-12">
                <h3 class="text-white bg-warning p-1 rounded">
                    {{$name}}
                </h3>
            </div>
        </div>
        <!-- all article  -->
        
        @if(count($products))
        <div class="row mt-3">
            
            @foreach($products as $pro)
            <div class="col-sm-3 mb-3">
                <div class="card w-100 " style="">
                    <div style="height: 200px">
                    <img src="{{asset($pro->thumbnail)}}" style="height: 200px" class="card-img-top h-100" alt="Product Thumbnail">
                    </div>
                    <div class="card-body" style="height: 200px">
                        <h5 class="card-title">{{$pro->name}}</h5>
                        <p class="card-text">{{$pro->description}}</p>
                        <a href="{{route('product_detail', $pro->id)}}" class="btn btn-primary">Read More</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-sm-12">
                {{$products->links()}}
            </div>
        </div>
        @else 
        <div class="row">
            <div class="col">
                <h5 class="text-danger text-center">There is no record...</h5>
            </div>
        </div>
        @endif
    </div>
@endsection