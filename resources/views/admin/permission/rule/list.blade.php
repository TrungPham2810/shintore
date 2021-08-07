@extends('admin.layouts.admin')
@section('title')
    <title>List Rule</title>
@endsection
@section('css')
@endsection
@section('content')

    <div class="right_col" role="main" style="min-height: 1661px;">
        <!-- Main content -->
        <div class="content">
            @include('admin.layouts.content-header', ['name'=>'Rule', 'action' => 'List', 'url' => route('admin.rule.index')])
            @if(session('message'))
                <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 p-2">
                        <div class="dropdown show float-right mr-5">
                            <a href="{{route('admin.rule.create')}}" class="btn btn-primary float-right">Add Rule</a>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Rule Key</th>
                                <th>Parent</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                            @foreach($data as $rule)
                                <tr>
                                    <td>{{$rule->id}}</td>
                                    <td>{{$rule->name}}</td>
                                    <td>{{$rule->rule_key}}</td>
                                    <td>{{optional($rule->ruleParent)->name}}</td>
                                    <td>
                                        {{--<a class="btn btn-info" href="{{route('admin.rule.edit', ['id'=>$rule->id])}}">Edit</a>--}}
                                        <button class="btn btn-danger delete_rule" data-url="{{route('admin.rule.delete', ['id'=>$rule->id])}}">Delete</button>
                                    </td>
                                </tr>
                                @endforeach
                                </tr>
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
