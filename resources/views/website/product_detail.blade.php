@extends('layouts.webs.master')
@section('meta')
    <meta name="description"
        content="CamboTransportClub.Com is one of the top 10 Car Rental Companies in Cambodia with more than 38 cars and more than 30 employees. It was founded on June 1, 2001 in Phnom Penh, Cambodia. CamboTransportClub.Com not only rents cars at a competitive price but also creates employment and training opportunities for local young students graduated from NGOs, OIs or any private institution and poor students from remote provinces so that they can enjoy internship in the field of tourism." />
    <meta name="keywords"
        content="Car, car rental, car in cambodia, car for sell, car for rent, tourism, tourism in cambodia, cambodia tourism, tour, cambodia tour ">
    <!-- meta content  -->
    <!-- Open Graph data -->
    <meta property="og:name" content="{{$product->name}}" />
    <meta property="og:type" content="Product"/>
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:image" content="{{asset($product->thumbnail)}}" />
    <meta property="og:description" content="{{$product->description}}" />
    <meta property="og:site_name" content="Laravel new Webiste" />

@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-primary">{{$product->name}}</h3>
            <p class="text-secondary fs-6">
                <i>Price: {{$product->sell_price}}$</i>
            </p>
            <a href="{{route('order.index')}}" class="btn btn-primary">Buy now</a>
            <br>
            <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}">
                Share to FB
            </a>
            <div>
                {!! $product->description !!}
            </div>
            <img src="{{asset($product->thumbnail)}}" alt="" class="img-fluid">

        </div>
    </div>
@endsection