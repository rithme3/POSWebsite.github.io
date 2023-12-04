@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('invoice.index')}}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h3>Invoice Detail</h3>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h2>Logo</h2>
                        <h2>Company name</h2>
                        <h2>Address----</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 ">
                        <h4>Invoice No. :{{$invoice->inv_no}}</h4>
                        <h4>Invoice Date :{{Carbon\Carbon::parse($invoice->created_at)->format('d/m/Y')}}</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Name</td>
                                    <td>Quantity</td>
                                    <td>Unit Price</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                $sub_total=0;
                                ?>
                                @foreach($invoice_details as $k => $detail)
                                <?php
                                $sub_total += $detail->total_price;
                                ?>
                                <tr>
                                    <td>{{$k + 1}}</td>
                                    <td>{{$detail->product_name}}</td>
                                    <td>{{$detail->quantity}}</td>
                                    <td>${{number_format($detail->price,2)}}</td>
                                    <td>${{number_format($detail->total_price,2)}}</td>
                                    <!-- <td>
                                        <a href="{{route('invoice.detail',$invoice->id)}}"
                                            class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                    </td> -->
                                </tr>
                                @endforeach
                                <tr>
                                <td colspan="4" class="text-right"> <strong>Sub Total:</strong></td>
                                <td>${{number_format($sub_total,2)}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection