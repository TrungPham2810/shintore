@extends('admin.layouts.admin')
@section('title')
    <title>Add Rule</title>
@endsection
@section('css')
    <link href="{{asset('admins/assets/css/permission.css')}}" rel="stylesheet"/>
@endsection
@section('content')
    <div class="right_col" role="main" style="min-height: 1661px;">
        @include('admin.layouts.content-header', ['name'=>'Rule', 'action' => 'Add', 'url' => route('admin.rule.index')])
        @if(session('message'))
            <div class="alert alert-danger">{{session('message')}}</div>
        @endif

    <!-- Main content -->
        <form method="POST" action="{{ route('admin.rule.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 p-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Select Module</label>

                                <select class="form-control" name="module_name" id="">
                                    <option>Select Module</option>
                                    @foreach(config('permissions.table_module') as $table)
                                        <option value="{{$table}}">{{$table}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card mb-3 col-md-12">
                            <div class="row">
                                @foreach(config('permissions.module_action') as $action)
                                    <div class="col-md-3">
                                        <div class="checkbox_rule">
                                            <input
                                                    name="action[]"
                                                    value="{{$action}}"
                                                    type="checkbox">
                                            {{$action}}
                                        </div>
                                    </div>
                                @endforeach
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

    <!-- /.content -->
@endsection

@section('js')
@endsection
