@extends('admin.layouts.admin')
@section('title')
    <title>List Role</title>
@endsection
@section('css')
@endsection
@section('content')

    <div class="right_col" role="main" style="min-height: 1661px;">
        <!-- Main content -->
        <div class="content">
            @include('admin.layouts.content-header', ['name'=>'Role', 'action' => 'List', 'url' => route('admin.role.index')])
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <div class="dropdown show float-right mr-5">
                            <a href="{{route('admin.role.create')}}" class="btn btn-primary float-right">Add Role</a>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Role Key</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->role_key}}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{route('admin.role.edit', ['id'=>$role->id])}}">Edit</a>
                                            <button class="btn btn-danger delete_role" data-url="{{route('admin.role.delete', ['id'=>$role->id])}}">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <!-- /.content -->
@endsection

@section('js')
    <script src="{{asset('admins/assets/list/list.js')}}"></script>
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@10.js')}}"></script>
@endsection
