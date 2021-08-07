@extends('admin.layouts.admin')
@section('title')
    <title>Add Category</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="right_col" role="main" style="min-height: 1661px;">
    @include('admin.layouts.content-header', ['name'=>'ImportData', 'action' => '', 'url' => '#'])
    <!-- Main content -->
        <div class="content">
            @if(session('message'))
                <div class="alert alert-danger">{{session('message')}}</div>
            @endif
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 p-2">
                        <form method="POST" action="{{ route('admin.importdata.import') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Import file Csv</label>
                                <input type="file" class="form-control-file" name="import_data" id="import_data">
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
