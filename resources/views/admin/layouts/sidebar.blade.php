<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{url('/admin')}}" class="site_title">
                <img class="logo main_logo" src="{{asset('images/logo.png')}}" alt="">
                <img class="icon_logo" src="{{asset('images/logo_icon.png')}}" alt="">
            </a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{asset('admins/assets/images/img.jpg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{auth()->user()->name}}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fas fa-home"></i> Catalog <span class="fas fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.categories.index')}}">Categories</a></li>

                        </ul>
                    </li>
                    <li>
                        <a href="{{route('admin.product.index')}}"><i class="fas fa-table"></i>Product</a>
                    </li>
                    <li><a><i class="fas fa-desktop"></i>Web<span class="fas fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">Configuration</a></li>
                            <li><a href="{{route('admin.importdata.index')}}">Import Data</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fas fa-clone"></i>Permissions<span class="fas fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.user.index')}}">All Users</a></li>
                            <li><a href="{{route('admin.role.index')}}">Roles</a></li>
                            <li><a href="{{route('admin.rule.index')}}">Rules</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
        <!-- /sidebar menu -->


    </div>
</div>
