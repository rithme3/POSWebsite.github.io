@extends('layouts.master')

@section('content')
<div class="row">
    <div class="col-sm-12">
       
        <div class="row mb-3">
            <div class="col-sm-12">
                <a href="{{route('dashboard')}}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <h1 class="text-danger">You don't have permission to access this feature!</h1>
    </div>
</div>
@endsection