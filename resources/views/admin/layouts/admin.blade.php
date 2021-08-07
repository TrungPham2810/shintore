 <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{asset('images/icon.png')}}" type="image/png" sizes="32x32"/>
        @yield('title')
        <!-- Bootstrap -->
        <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{asset('vendors/fontawesome/css/fontawesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('vendors/fontawesome/css/brands.css')}}" rel="stylesheet">
        <link href="{{asset('vendors/fontawesome/css/solid.css')}}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{asset('admins/assets/build/css/custom.min.css')}}" rel="stylesheet">
        <link href="{{asset('admins/assets/css/admin.css')}}" rel="stylesheet">
        @yield('css')
    </head>

    <body class="nav-md">
    <div class="container body">
        <div class="main_container">
        @include('admin.layouts.sidebar')

            <!-- top navigation -->
        @include('admin.layouts.header')
            <!-- /top navigation -->

            <!-- page content -->
                @yield('content')
            <!-- /page content -->

            <!-- footer content -->

        @include('admin.layouts.footer')
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Custom Theme Scripts -->
    <script src="{{asset('admins/assets/build/js/custom.min.js')}}"></script>
    @yield('js')
    </body>
    </html>
