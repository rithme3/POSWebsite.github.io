@extends('layouts.master')

@section('content')
<div class="row">
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

                <table class="table table-bordered datatable" id="dataTable" style="width:99.8%">
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
@section('custom-js')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function(){
            var table = $('#dataTable').DataTable({
               pageLength: 5,
               processing: true,
               serverSide: true,
               scrollX: true,
               ajax: "{{ route('product.index') }}",
               columns: [
                   {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                   {data: 'name', name: 'name'},
                //    {data: 'username', name: 'username'},
                   {
                       data: 'action',
                       name: 'action',
                       orderable: false,
                       searchable: false
                   },
               ]
              
            });
           //save data
            // $('#btn_save').click(function(){
            //     let token = $('input[name=_token]').val();
            //     let name = $('#product').val();
            //     let file = $('#files').val();
            //     $.ajax({
            //         type: "POST",
            //         url: "{{route('product.save')}}",
            //         data: {
            //             'name': name, 
            //             'file': file, 
            //             '_token': token
            //         },
            //         success: function (response) {
            //             console.log(response);
            //             if(response.status == 200){
            //                 $('#product').val('');
            //                 $('#createModal').modal('hide');

            //                 $('#dataTable').DataTable().ajax.reload();
            //             }
            //         },
            //         error: function (e) {
            //             console.log(e);
            //         }
            //    });
            // })
            //edit data
            // $('#btn_edit').click(function(){
            //     let token = $('input[name=_token]').val();
            //     let name = $('#e_category').val();
            //     let file = $('#files').val();
            //     let id = $('#e_id').val();
            //     $.ajax({
            //         type: "POST",
            //         url: "{{route('category.update')}}",
            //         data: {
            //             'id': id, 
            //             'name': name, 
            //             'file': file, 
            //             '_token': token
            //         },
            //         success: function (response) {
            //             console.log(response);
            //             if(response.status == 200){
            //                 $('#e_category').val('');
            //                 $('#editModal').modal('hide');

            //                 $('#dataTable').DataTable().ajax.reload();
            //             }
            //         },
            //         error: function (e) {
            //             console.log(e);
            //         }
            //    });
            // })
        // })
        // function saveData(event){
        //     event.preventDefault();
            
        //     let token = $('input[name=_token]').val();
        //         let name = $('#e_category').val();
        //         let file = $('#files').val();
        //         let id = $('#e_id').val();
        //         $.ajax({
        //             type: "POST",
        //             url: "{{route('category.update')}}",
        //             data: {
        //                 'id': id, 
        //                 'name': name, 
        //                 'file': file, 
        //                 '_token': token
        //             },
        //             success: function (response) {
        //                 console.log(response);
        //                 if(response.status == 200){
        //                     $('#e_category').val('');
        //                     $('#editModal').modal('hide');

        //                     $('#dataTable').DataTable().ajax.reload();
        //                 }
        //             },
        //             error: function (e) {
        //                 console.log(e);
        //             }
        //        });
        // }
    //     function editRow(id, even){
    //         $.ajax({
    //                 type: "GET",
    //                 url: "{{route('category.edit', '')}}/"+id,
    //                 success: function (response) {
    //                     console.log(response)
    //                     if(response.status == 200){
    //                         $('#e_id').val(response.data.id);
    //                         $('#e_category').val(response.data.name);
    //                         $('#editModal').modal('show');
    //                     }
    //                 },
    //                 error: function (e) {
    //                     console.log(e);
    //                 }
    //            });
    //         }

    //     function removeRow(id, even){
    //         $.ajax({
    //                 type: "GET",
    //                 url: "{{route('category.delete', '')}}/"+id,
    //                 success: function (response) {
    //                     console.log(response);
    //                     if(response.status == 200){
    //                         // alert(response.sms)
    //                         $('#dataTable').DataTable().ajax.reload();
    //                     }
    //                 },
    //                 error: function (e) {
    //                     console.log(e);
    //                 }
    //            });
    //         }
    // 
    </script>
@endsection