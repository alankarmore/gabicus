<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="{{route('admin.categories')}}" class="site_title"><i class="fa fa-paw"></i> <span>Gabicus Admin!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile">
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</h2>
            </div>
            <div class='clearfix'></div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-table"></i> Categories <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.categories')}}">Categories</a></li>
                            <li><a href="{{route('admin.categories.create')}}">Add Category</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Courses<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.courses')}}">Courses</a></li>
                            <li><a href="{{route('admin.courses.create')}}">Add Course</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Alumnies<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.alumnies')}}">Alumnies</a></li>
                            <li><a href="{{route('admin.alumnies.create')}}">Add Alumni</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Enrollment<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.enroll')}}">All Enrollments</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Corporate Training<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.corporatetraining')}}">Corporate Training</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i> Teach With US<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.teachwithus')}}">Teach With Us</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>