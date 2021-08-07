@extends('admin.layouts.admin')
@section('title')
    <title>List Category</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="right_col" role="main" style="min-height: 1661px;">
    @include('admin.layouts.content-header', ['name'=>'Category', 'action' => 'List', 'url' => route('admin.categories.index')])
        <!-- Main content -->
        <div class="content">
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <a href="{{route('admin.categories.create')}}" class="btn btn-primary float-right">Add Category</a>
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Parent</th>
                                <th>Url Key</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        @if($category->parent_id == 0)
                                            {{$category->parent_id}}
                                        @else
                                            {{optional($category->categoryParent)->name}}
                                        @endif

                                    </td>
                                    <td>{{$category->url_key}}</td>
                                    <td>
                                        @if($category->status)
                                            {{'Enable'}}
                                        @else
                                            {{'Disable'}}
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-info" href="{{route('admin.categories.edit', ['id'=>$category->id])}}">Edit</a>
                                        <button class="btn btn-danger delete_category" data-url="{{route('admin.categories.delete', ['id'=>$category->id])}}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="col-sm-12">
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
