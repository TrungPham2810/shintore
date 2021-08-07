@extends('admin.layouts.admin')
@section('title')
    <title>Add Role</title>
@endsection
@section('css')
    <link href="{{asset('admins/assets/css/permission.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="right_col" role="main" style="min-height: 1661px;">
        @include('admin.layouts.content-header', ['name'=>'Role', 'action' => 'Add', 'url' => route('admin.role.index')])
        @if(session('message'))
            <div class="alert alert-danger">{{session('message')}}</div>
        @endif

    <!-- Main content -->
        <form method="POST" action="{{ route('admin.role.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 p-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" required class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" name="name" placeholder="Name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Role Key</label>
                                <input type="text" required pattern="[a-z0-9_^]+" class="form-control @error('role_key') is-invalid @enderror" value="{{old('role_key')}}" name="role_key" placeholder="Role Key">
                                @error('role_key')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card mb-3 col-md-12">
                            <div class="card-header">
                                <div class="rule_module">
                                    <input
                                            name="rule[]"
                                            value=""
                                            class="check_all"
                                            type="checkbox">
                                    Check All
                                </div>

                            </div>
                        </div>
                        @foreach($rules as $item)
                            <div class="col-sm-12 show_list_permission">
                                <div class="row">

                                    <div class="card mb-3 col-md-12">
                                        <div class="card-header">
                                            <div class="rule_module">
                                                    <input class="checkbox_wrapper" type="checkbox">{{$item->name}}
                                            </div>

                                        </div>
                                        <div class="row">
                                            @foreach($item->ruleChildren as $itemChild)
                                                <div class="card-body col-md-3">
                                                    <div class="card-title rule_child" >
                                                        <input type="checkbox" class="checkbox_child" value="{{$itemChild->id}}" name="rule[]">{{$itemChild->name}}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>

                            </div>
                        @endforeach

                        <div class="col-sm-12">

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

        </form>
    </div>

    <!-- /.content -->
@endsection

@section('js')
    <script src="{{asset('admins/assets/js/role.js')}}"></script>
@endsection
