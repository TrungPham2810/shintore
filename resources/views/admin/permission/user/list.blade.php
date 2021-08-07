@extends('admin.layouts.admin')
@section('title')
    <title>List User</title>
@endsection
@section('css')
@endsection
@section('content')

    <div class="right_col" role="main" style="min-height: 1661px;">
        <!-- Main content -->
        <div class="content">
            @include('admin.layouts.content-header', ['name'=>'User', 'action' => 'List', 'url' => route('admin.user.index')])
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <div class="dropdown show float-right mr-5">
                            <a href="{{route('admin.user.create')}}" class="btn btn-primary float-right">Add User</a>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $user)
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{optional($user->role()->first())->name}}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{route('admin.user.edit', ['id'=>$user->id])}}">Edit</a>
                                            <button class="btn btn-danger delete_user" data-url="{{route('admin.user.delete', ['id'=>$user->id])}}">Delete</button>
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
