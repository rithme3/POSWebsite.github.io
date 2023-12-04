@extends('layouts.master')

@section('content')
<div class="row d-md-none d-block">
    <div class="col-sm-12">
        <!-- <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('category.create')}}" class="btn btn-primary">Create</a>
            </div>
        </div> -->
        <div class="card">
            <div class="card-body">
                <h3>List of invoice</h3>
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
                                <th>Invoice_No.</th>
                                <th>Total_Amount</th>
                                <th>Created_By</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $k => $invoice)
                            <tr>
                                <td>{{$invoices->firstItem() + $k}}</td>
                                <td>{{$invoice->inv_no}}</td>
                                <td>${{number_format($invoice->total_amount)}}</td>
                                <td>{{$invoice->created_by}}</td>
                                
                                <td>
                                    <a href="{{route('invoice.detail',$invoice->id)}}" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
                                    <a href="{{route('invoice.print',$invoice->id)}}" taget="_blank" class="btn btn-success btn-xs"><i class="fa fa-print"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                    
                <div class="row">
                    <div class="col-sm-12">
                    {{$invoices->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row d-none d-md-block">
    <div class="col-sm-12">
        <!-- <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('category.create')}}" class="btn btn-primary">Create</a>
            </div>
        </div> -->
        <div class="card">
            <div class="card-body">
                <h3>List of invoice</h3>
                @if(session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{session()->get('success')}}
                </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>Invoice No.</td>
                            <td>Total Amount</td>
                            <td>Created By</td>
                            <td>Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoices as $k => $invoice)
                        <tr>
                            <td>{{$invoices->firstItem() + $k}}</td>
                            <td>{{$invoice->inv_no}}</td>
                            <td>${{number_format($invoice->total_amount)}}</td>
                            <td>{{$invoice->created_by}}</td>
                            
                            <td>
                                <a href="{{route('invoice.detail',$invoice->id)}}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                <a href="{{route('invoice.print',$invoice->id)}}" taget="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12">
                    {{$invoices->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection