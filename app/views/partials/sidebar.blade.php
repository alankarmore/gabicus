<div class="sidebar-nav">
    <!-- navigation start -->
    @if(count($categoryCourses) > 0) 
    <div class="navmenu navmenu-default navmenu-fixed-right offcanvas" style="" id="navigation">
        <ul id="accordion" class="accordion">
            @foreach($categoryCourses as $category => $courses)
            <li>
                <div class="link">{{ucfirst($category)}}<i class="fa fa-chevron-down"></i></div>
                <ul class="submenu">
                    @foreach($courses as $course)
                    <li><a href="{{route('courses.show',array('name' => $course->slug))}}">{{ucfirst($course->title)}}</a></li>
                    @endforeach
                </ul>
            </li>
            @endforeach
        </ul>  
    </div>
    @endif
    <!-- navigation End -->
</div>