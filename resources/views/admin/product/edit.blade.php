@extends('admin.layouts.admin')
@section('title')
    <title>Edit Product</title>
@endsection
@section('css')
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="right_col" role="main" style="min-height: 1661px;">
    @include('admin.layouts.content-header', ['name'=>'Product', 'action' => 'Edit', 'url' => route('admin.product.index')])
    <!-- Main content -->
        <div class="content">
            @if(session('message'))
                <div class="alert alert-danger">{{session('message')}}</div>
            @endif

                <form method="POST" action="{{ route('admin.product.update',['id'=>$product->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-sm-6 p-2">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Truyện</label>
                                    <input type="text" class="form-control @error('product_name') is-invalid @enderror"
                                           value="{{$product->name}}" name="product_name" id="" placeholder="Tên Truyện" required>
                                    @error('product_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Sku</label>
                                    <input type="text" class="form-control @error('sku') is-invalid @enderror"
                                           value="{{$product->sku}}" name="sku" id="" placeholder="sku" required>
                                    @error('sku')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Import Price</label>
                                    <input type="number" class="form-control @error('import_price') is-invalid @enderror" name="import_price"
                                           placeholder="Gía Nhập" value="{{$product->import_price}}" id="product_import_price">
                                    @error('import_price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$product->price}}" id="product_price">
                                    @error('price')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quantity</label>
                                    <input type="number" class="form-control @error('qty') is-invalid @enderror" name="qty" value="{{$product->qty}}" id="product_qty">
                                    @error('qty')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Url Key (don't have space, special charactor, capitalize letter.)</label>
                                    <input type="text" pattern="[a-z0-9_\-^]+" class="form-control @error('url_key') is-invalid @enderror"
                                           value="{{$product->url_key}}" required name="url_key" id="" placeholder="url key">
                                    @error('url_key')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Category</label>
                                    <select class="form-control select2_init @error('category_id') is-invalid @enderror"
                                            id="exampleFormControlSelect1" name="category_id" required>
                                        {!! $htmlSelect !!}
                                    </select>
                                    @error('category_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Current Image</label>
                                    <div>
                                        <img src="{{asset($product->image_path)}}" alt="{{asset($product->image_name)}}" style="height: 200px">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" class="form-control-file" name="image_path" id="product_image">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Miêu Tả</label>
                                    <textarea rows="8" name="description" class="form-control tinymce_editor_int ">{{$product->description}}</textarea>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
                </form>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script src="{{asset('vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('admins/assets/product/add/add.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
@endsection
