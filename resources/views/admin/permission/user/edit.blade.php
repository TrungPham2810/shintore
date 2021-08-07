@extends('admin.layouts.admin')
@section('title')
    <title>Edit User</title>
@endsection
@section('css')
    <link href="{{asset('admins/assets/css/permission.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="right_col" role="main" style="min-height: 1661px;">
    @include('admin.layouts.content-header', ['name'=>'User', 'action' => 'Edit', 'url' => route('admin.user.index')])
    <!-- Main content -->
        @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <form method="POST" action="{{ route('admin.user.update', ['id'=> $user->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 p-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" required class="form-control @error('name') is-invalid @enderror" value="{{$user->name}}" name="name" placeholder="Name Slider">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="email" required class="form-control @error('email') is-invalid @enderror" value="{{$user->email}}" name="email" placeholder="Email">
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Password</label>
                                <input type="password" id="password" class="form-control" name="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" class="form-control-file" name="user_image" id="user_image">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">New Password</label>
                                <input type="password" id="new_password" class="form-control" name="new_password" placeholder="Password">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Confirm Password</label>
                                <input type="password" id="confirm_password" class="form-control" placeholder="Confirm Password">
                            </div>

                            <div class="form-group">
                                <label for="exampleFormControlSelect1">User Role</label>
                                <select class="form-control roles_select" id="roles" name="role">
                                    <option value=""></option>
                                    @foreach($roles as $role)
                                        <option {{$currentRoles->contains('id', $role->id)? 'selected': ''}}
                                                value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-sm-12">

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
        </form>
    </div>
@endsection
@section('js')
    <script src="{{asset('admins/assets/js/user/edit.js')}}"></script>
@endsection
