@extends('layouts.master')

@section('content')
<div class="row d-md-none d-block">
    <div class="col-sm-12">
        <div class="card mb-3">
            <div class="card-body">
                <h3>Making Order</h3>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
                @endif
                <form class="row" action="{{route('order.save_cart')}}" method="post">
                    @csrf
                    <div class="col-6">
                        <div class="form-group">
                            <label for="product_id">Product<span class="text-danger">*</span></label>
                            <select name="id" id="product_id" class="form-control" required>
                                <option value="">-------</option>
                                @foreach($products as $pro)
                                <option value="{{$pro->id}}">{{$pro->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="quantity">Quantity<span class="text-danger">*</span></label>
                            <input type="number" min="1" name="quantity" id="quantity" value="1" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-6"></div>
                    <div class="col-6">
                        <div class="row p=0">
                            <div class="form-group mr-2 ml-2">
                                <br>
                                <button class="btn btn-sm btn-primary">At to Cart</button>
                            </div>
                            <div class="form-group">
                                <br>
                                <a href="{{route('order.clear_all')}}" class="btn btn-sm btn-danger ">Clear all</a>   
                            </div>
                        </div>
                    </div>
                </form>
                <form action="{{route('order.save')}}" method="post">
                    @csrf
                    <table class="table table-bordered table-sm" >
                        <thead>
                            <tr>
                                <td style="font-size: 12px;">No.</td>
                                <td style="font-size: 12px;">Image</td>
                                <td style="font-size: 12px;">Name</td>
                                <td style="font-size: 12px;">Quantity</td>
                                <td style="font-size: 12px;">Price</td>
                                <td style="font-size: 12px;">Total</td>
                                <td style="font-size: 12px;">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sub_total=0;
                            ?>
                            @foreach($cartItems as $k => $cart)
                            <?php
                            $sub_total += $cart->price * $cart->quantity;
                            ?>
                            <input type="hidden" name="id[]" value="{{$cart->id}}">
                            <input type="hidden" name="price[]" value="{{$cart->price}}">
                            <input type="hidden" name="quantity[]" value="{{$cart->quantity}}">
                            <input type="hidden" name="total[]" value="{{$cart->price * $cart->quantity}}">
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>
                                    <img src="{{asset($cart->attributes->image)}}" alt="Thumbnail" width="50px" >
                                </td>
                                <td>{{$cart->name}}</td>
                                <td>{{$cart->quantity}}</td>
                                <td>{{$cart->price}}</td>
                                <td>{{$cart->price * $cart->quantity}}</td>
                                <td>
                                    <a href="{{route('order.remove', $cart->id)}}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-right"> Sub Total:</td>
                                <td>${{number_format($sub_total,2)}}</td>
                                <td ><button class="btn btn-primary">Save order</button></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row d-none d-md-block">
    <div class="col-sm-12">
        <div class="card mb-3">
            <div class="card-body">
                <h3>Making Order</h3>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
                @endif
                <form class="row" action="{{route('order.save_cart')}}" method="post">
                    @csrf
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="product_id">Product<span class="text-danger">*</span></label>
                            <select name="id" id="product_id" class="form-control" required>
                                <option value="">-------</option>
                                @foreach($products as $pro)
                                <option value="{{$pro->id}}">{{$pro->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="quantity">Quantity<span class="text-danger">*</span></label>
                            <input type="number" min="1" name="quantity" id="quantity" value="1" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="row">
                            <div class="form-group mr-2 ml-2">
                                <br>
                                <button class="btn btn-primary mt-2">At to Cart</button>
                            </div>
                            <div class="form-group mr-2 ml-2">
                                <br>
                                <a href="{{route('order.clear_all')}}" class="btn btn-danger mt-2 ">Clear all Cart</a>   
                            </div>
                        </div>
                    </div>
                </form>
                <form action="{{route('order.save')}}" method="post">
                    @csrf
                    <table class="table table-bordered table-sm" >
                        <thead>
                            <tr>
                                <td style="font-size: 12px;">No.</td>
                                <td style="font-size: 12px;">Image</td>
                                <td style="font-size: 12px;">Name</td>
                                <td style="font-size: 12px;">Quantity</td>
                                <td style="font-size: 12px;">Price</td>
                                <td style="font-size: 12px;">Total</td>
                                <td style="font-size: 12px;">Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sub_total=0;
                            ?>
                            @foreach($cartItems as $k => $cart)
                            <?php
                            $sub_total += $cart->price * $cart->quantity;
                            ?>
                            <input type="hidden" name="id[]" value="{{$cart->id}}">
                            <input type="hidden" name="price[]" value="{{$cart->price}}">
                            <input type="hidden" name="quantity[]" value="{{$cart->quantity}}">
                            <input type="hidden" name="total[]" value="{{$cart->price * $cart->quantity}}">
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>
                                    <img src="{{asset($cart->attributes->image)}}" alt="Thumbnail" width="50px" >
                                </td>
                                <td>{{$cart->name}}</td>
                                <td>{{$cart->quantity}}</td>
                                <td>{{$cart->price}}</td>
                                <td>{{$cart->price * $cart->quantity}}</td>
                                <td>
                                    <a href="{{route('order.remove', $cart->id)}}" class="btn btn-danger"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5" class="text-right"> Sub Total:</td>
                                <td>${{number_format($sub_total,2)}}</td>
                                <td ><button class="btn btn-primary">Save order</button></td>
                            </tr>
                            
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom-js')
@if(session()->has('print_url'))
    <script>
        var url = "{{session()->get('print_url')}}";
        window.open(url,'_blank')
    </script>
@endif
@endsection