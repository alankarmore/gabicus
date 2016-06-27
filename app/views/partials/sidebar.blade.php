                <div class="sidebar-nav">
                    <!-- navigation start -->
                    <div class="navmenu navmenu-default navmenu-fixed-right offcanvas" style="" id="navigation">
                        <a href="{{route('/')}}">
                            <img class="logo" src="{{asset('assets/img/logo.png')}}" alt="logo"></a>
                        <ul class="nav navmenu-nav">
                            @foreach($courses as $course)
                                <li><a href="{{route('courses.show',array('name' => $course->slug))}}">{{ucfirst($course->title)}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- navigation End -->
                </div>