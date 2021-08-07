@extends('admin.layouts.admin')
@section('title')
    <title>Edit Rules</title>
@endsection
@section('css')
    <link href="{{asset('admins/assets/css/permission.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="right_col" role="main" style="min-height: 1661px;">
    @include('admin.layouts.content-header', ['name'=>'Rule', 'action' => 'Edit', 'url' => route('admin.rule.index')])
    <!-- Main content -->
        @if(session('message'))
            <div class="alert alert-danger">{{session('message')}}</div>
        @endif
        <form method="POST" action="{{ route('admin.rule.update', ['id'=>$rule->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 p-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" required class="form-control @error('name') is-invalid @enderror"
                                       value="{{$rule->name}}" name="name" placeholder="Name">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Rule Key</label>
                                <input type="text" required class="form-control @error('rule_key') is-invalid @enderror"
                                       value="{{$rule->rule_key}}" name="rule_key" placeholder="Rule Key">
                                @error('rule_key')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="card mb-3 col-md-12">
                            <div class="card-header">
                                <h4>
                                    <label>
                                        <input
                                                name="permission[]"
                                                value=""
                                                class="check_all"
                                                type="checkbox">
                                        Check All
                                    </label>
                                </h4>

                            </div>
                        </div>
                        @foreach($permissions as $item)
                            <div class="col-sm-12 show_list_permission">
                                <div class="row">
                                    <div class="card mb-3 col-md-12">
                                        <div class="card-header">
                                            <h4>
                                                <label>
                                                    <input
                                                            {{$currentPermission->contains('id', $item->id)? 'checked': ''}}
                                                            name="permission[]"
                                                            value="{{$item->id}}"
                                                            class="checkbox_wrapper"
                                                            type="checkbox">
                                                    {{$item->display_name}}
                                                </label>
                                            </h4>

                                        </div>
                                        <div class="row">
                                            @foreach($item->permissionsChildrent as $itemChild)
                                                <div class="card-body col-md-3">
                                                    <div class="card-title">
                                                        <label>
                                                            <input
                                                                    type="checkbox"
                                                                    {{$currentPermission->contains('id', $itemChild->id)? 'checked': ''}}
                                                                    class="checkbox_child"
                                                                    value="{{$itemChild->id}}"
                                                                    name="permission[]">{{$itemChild->display_name}}
                                                        </label>
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
@endsection
@section('js')
@endsection
