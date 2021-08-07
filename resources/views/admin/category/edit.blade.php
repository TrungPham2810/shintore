@extends('admin.layouts.admin')
@section('title')
    <title>Edit Category</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="right_col" role="main" style="min-height: 1661px;">
    @include('admin.layouts.content-header', ['name'=>'Category', 'action' => 'Edit', 'url' => route('admin.categories.index')])
    <!-- Main content -->
        <div class="content">
            @if(session('message'))
                <div class="alert alert-danger">{{session('message')}}</div>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 p-2">
                        <form method="POST" action="{{ route('admin.categories.update', ['id'=>$category->id]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInput">Category Name</label>
                                <input type="text" class="form-control @error('category_name') is-invalid @enderror" value="{{$category->name}}" required name="category_name" id="exampleInput" placeholder="Name Category">
                                @error('category_name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Url Key (don't have space, special charactor, capitalize letter.)</label>
                                <input type="text" pattern="[a-z0-9_\-^]+" class="form-control @error('url_key') is-invalid @enderror" value="{{$category->url_key}}" required name="url_key" id="exampleInput" placeholder="Url Key">
                                @error('url_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Is Active</label>
                                <input class="form-check-input" {{$category->status ? "checked" : ''}} type="checkbox" name="status" id="is_active">
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Parent</label>
                                <select class="form-control" name="parent_id" id="exampleFormControlSelect1" required>
                                    <option value="0">Please select Category...</option>
                                    {!! $htmlSelect !!}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Miêu Tả</label>
                                <textarea rows="8" name="description" class="form-control tinymce_editor_int ">{{$category->description}}</textarea>

                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
