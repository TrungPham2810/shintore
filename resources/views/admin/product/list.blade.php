@extends('admin.layouts.admin')
@section('title')
    <title>List Product</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="right_col" role="main" style="min-height: 1661px;">
    @include('admin.layouts.content-header', ['name'=>'Product', 'action' => 'List', 'url' => route('admin.product.index')])
        <!-- Main content -->
        <div class="content">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <a href="{{route('admin.product.create')}}" class="btn btn-primary float-right">Add Product</a>
                    </div>
                    <div class="col-sm-12 d-flex justify-content-center">
                        {{ $data->links() }}
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Sku</th>
                                <th>Price</th>
                                <th>Import Price</th>
                                <th>Qty</th>
                                <th>Category</th>
                                <th>Url Key</th>
                                <th>State</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td><img class="small_image_product" style="" src="{{asset($product->image_path)}}" alt="{{$product->image_name}}"></td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->sku}}</td>
                                    <td>{{number_format($product->price, 0, '.', '.')}} VNĐ</td>
                                    <td>{{number_format($product->import_price, 0, '.', '.')}} VNĐ</td>
                                    <td>
                                        {{$product->qty}}
                                        @if($product->qty == 0)
                                         - <div style="padding: 5px; background: red" class="label-out-of-stock">Out Stock</div>
                                        @endif
                                    </td>
                                    <td>
                                        {{optional($product->category)->name}}
                                    </td>
                                    <td>{{$product->url_key}}</td>
                                    <td>
                                        {{ $product->state}}
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{route('admin.product.edit', ['id'=>$product->id])}}">Edit</a>
                                        <button class="btn btn-danger delete_product" data-url="{{route('admin.product.delete', ['id'=>$product->id])}}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12 d-flex justify-content-center">
                        {{ $data->links() }}
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="{{asset('admins/assets/list/list.js')}}"></script>
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
@endsection
