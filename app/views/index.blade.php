@extends('layouts.main')
@section('title', 'Gabicus India')
@section('content')
        <!-- Header Section Start -->
        <div id="header" class="banner-container">
            <div class="container">
                <div class="col-md-12 top-header">
                    <div class="logo-menu">
                        <!-- <div class="logo pull-left wow fadeInDown animated" data-wow-delay=".2s">
                             <a href="index.html">
                                 <img src="{{asset('assets/img/logo.png')}}" alt="logo"></a>
                         </div>-->
                        <div class="pull-right wow fadeInDown animated" data-wow-delay=".2">
                            <a href="{{route('teach-with-us')}}" class="margin-right10">Teach With Us</a> <span class="margin-right10">| </span>
                            <a href="{{route('corporate-training')}}" class="margin-right10">Corporate Training</a> <span class="margin-right10"> </span>                        
                            <div id="menu" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">
                                <span>menu</span>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar-nav">
                        <!-- navigation start -->
                        <div class="navmenu navmenu-default navmenu-fixed-right offcanvas" style="" id="navigation">
                            <a href="">
                                <img class="logo" src="{{asset('assets/img/logo.png')}}" alt="logo"></a>
                            <ul class="nav navmenu-nav">
                            @foreach($courses as $course)
                                <li><a href="{{route('courses.show',array('name' => $course->slug))}}">{{ucfirst($course->title)}}</a></li>
                            @endforeach
                            </ul>
                        </div>
                        <!-- navigation End -->
                    </div>
                </div>            <div class="row">
                    <div class="col-md-12">
                        <div class="banner text-center">
                            <!-- <h1 class="wow fadeInDown animated" data-wow-delay=".8s">BEST   LEARNING</h1>-->
                            <h2 class="wow fadeInDown animated" data-wow-delay=".6s">Niche Courses for Select Professionals</h2>
                            <div id="custom-search-input">
                                <div class="input-group col-md-6 wow fadeInLeft animated">
                                    <input type="text" class="form-control input-lg" placeholder="Search for Courses" id="search-courses"/>
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-lg" type="button">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                            <div class="scroll">
                                <a href="#works"><i class="fa fa-angle-down wow fadeInUp animated" data-wow-delay="1.2s"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Section End -->
    <!-- Work Section Start -->
    <section id="works">
        <div class="container">
            <div class="row">
                <!--  <h1 class="section-title wow fadeInLeft animated" data-wow-delay=".6s">We Bring You World’s Best Courses</h1>
                <div align="center" class="wow fadeInLeft animated margin-bottom50" data-wow-delay=".6s"><img src="assets/img/grey-sep.png" alt=""></div>-->
                <div class="col-md-12 col-lg-12 grid-left wow fadeInLeft animated" data-wow-delay="1.2s">

                    <ul class="advantages advantages_mod-b list-unstyled">
                        <li class="advantages__item wow zoomIn" data-wow-duration="2s" style="visibility: visible; animation-duration: 2s; animation-name: zoomIn;">
                            <div class="advantages__inner">
                                <div class="advantages__info">
                                    <span class="advantages__icon">
                                        <img src="{{asset('assets/img/icon1.jpg')}}" alt=""></span>
                                    <h3 class="ui-title-inner decor decor_mod-a">HIGHest RATINGS</h3>
                                </div>
                            </div>
                            <p>Our training methodology and content has received highest ratings from most corporate houses and organizations.</p>
                            <!--<a class="btn btn-primary btn-effect margin-top20" href="javascript:void(0);">Enroll</a>-->
                        </li>
                        <li class="advantages__item wow zoomIn" data-wow-duration="2s" data-wow-delay=".5s" style="visibility: visible; animation-duration: 2s; animation-delay: 0.5s; animation-name: zoomIn;">
                            <span class="advantages__icon">
                                <img src="{{asset('assets/img/icon2.jpg')}}" alt=""></span>
                            <div class="advantages__inner">
                                <h3 class="ui-title-inner decor decor_mod-a">SKILLED FACULTY</h3>
                                <div class="advantages__info">
                                    <p>Our trainers comes directly from the industry who not only share theoretical knowledge but demonstrate industry based practical use cases.</p>
                                    <!-- <a class="btn btn-primary btn-effect margin-top20" href="javascript:void(0);">Enroll</a>-->
                                </div>
                            </div>
                        </li>
                        <li class="advantages__item wow zoomIn" data-wow-duration="2s" data-wow-delay="1s" style="visibility: visible; animation-duration: 2s; animation-delay: 1s; animation-name: zoomIn;">
                            <span class="advantages__icon">
                                <img src="{{asset('assets/img/icon3.jpg')}}" alt=""></span>
                            <div class="advantages__inner">
                                <h3 class="ui-title-inner decor decor_mod-a">we are GLOBAL</h3>
                                <div class="advantages__info">
                                    <p>Our trainers comes from across the globe who are pioneers in their field. We make sure, we get best trainers for our students irrespective of geography.</p>
                                    <!--<a class="btn btn-primary btn-effect margin-top20" href="javascript:void(0);">Enroll</a>-->
                                </div>
                            </div>
                        </li>
                        <li class="advantages__item wow zoomIn" data-wow-duration="2s" data-wow-delay="1.5s" style="visibility: visible; animation-duration: 2s; animation-delay: 1.5s; animation-name: zoomIn;">
                            <span class="advantages__icon">
                                <img src="{{asset('assets/img/icon4.jpg')}}" alt=""></span>
                            <div class="advantages__inner">
                                <h3 class="ui-title-inner decor decor_mod-a">ONLINE TRAINING</h3>
                                <div class="advantages__info">
                                    <p>Online 24X7 trainings make it easier for our students to study at their own pace, at their convenient time and in the comfort of their home.</p>
                                    <!--<a class="btn btn-primary btn-effect margin-top20" href="javascript:void(0);">Enroll</a>-->
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- Work Section End  -->

    <!-- Skills Section Start -->
    <section id="skills">
        <div class="container">
            <div class="row">
                <h1 class="section-title wow fadeInLeft animated" data-wow-delay=".6s">Popular <span>Courses</span></h1>
                <div align="center" class="wow fadeInLeft animated margin-bottom50" data-wow-delay=".6s">
                    <img src="{{asset('assets/img/white-sep.png')}}" alt="">
                </div>

                <div align="left" class="col-md-5 col-lg-5 grid-left wow fadeInLeft animated" data-wow-delay="1.2s">
                    <!-- <h3 class="categories-tabs__title">HEALTH &amp; PSYCHOLOGY</h3>
                     <div class="categories-tabs__number">courses available : <strong class="color_primary">400</strong></div>
                     <div class="categories-tabs__description">
                         <p>Nulla feugiat nibh placerat fermentum rutrum anted risus euismod eros pharetra felis justo ac tortor. Maecenas odio sit amet odio euismod iaculis. Donec a tellus. Nullam risus turpis rhoncus vel varius consequat laoreet ac neque. Sed eget lectus vitae augue zitae condimen tum sit ame pede. </p>
                         <p>Aenean erat orci mollis quis. Lorem ipsum dolor siter amet, consectetur adipisicing elit sed do eiusmod tempor incididunt ut labore et dolore.</p>
                     </div>
                     <a class="btn btn-primary btn-effect margin-top20" href="javascript:void(0);">SEE COURSES</a>-->
                </div>

                <!--<div class="col-md-6 grid-right wow fadeInRight animated" data-wow-delay="1.6s">
                    <div class="col-md-12">
                        @foreach($popularCourses as $course)
                            <div class="col-md-4"><a href="{{route('courses.show',array('name' => $course->slug))}}">{{ucfirst($course->title)}}</a></div> 
                        @endforeach
                        <div class="col-md-4"><a href="{{route('/')}}"><img src="{{asset('assets/img/course1.jpg')}}" alt=""></a></div> 
                        <div class="col-md-4"><a href="{{route('/')}}"><img src="{{asset('assets/img/course2.jpg')}}" alt=""></a></div> 
                        <div class="col-md-4"><a href="{{route('/')}}"><img src="{{asset('assets/img/course3.jpg')}}" alt=""></a></div>
                    </div>
                    <div class="clear"></div>
                    <div class="col-md-12 margin-top20">
                        <div class="col-md-6 text-right"><a href="{{route('/')}}"><img src="{{asset('assets/img/course4.jpg')}}" alt=""></a></div> 
                        <div align="left" class="col-md-6 text-left"><a href="{{route('/')}}"><img src="{{asset('assets/img/course5.jpg')}}" alt=""></a></div></div>
                </div>-->
				
				<div class="col-md-6 grid-right wow fadeInRight animated" data-wow-delay="1.6s">
					<ul class="courses">
						<li><a href="#" class="blue-box"><img src="assets/img/icon5.png" alt=""><br> Test</a></li>
						<li><a href="#" class="peacockblue-box"><img src="assets/img/icon5.png" alt=""><br> Test</a></li>
						<li><a href="#" class="purple-box"><img src="assets/img/icon5.png" alt=""><br> Test</a></li>
						<li><a href="#" class="yellow-box"><img src="assets/img/icon5.png" alt=""><br>  Test</a></li>
						<li><a href="#" class="green-box"><img src="assets/img/icon5.png" alt=""><br>  Test</a></li>
						<li><a href="#" class="red-box"><img src="assets/img/icon5.png" alt=""><br>  Test</a></li>
					</ul>
				  </div>
				
            </div>
        </div>
    </section>
    <!-- Skills Section End -->

    <!-- Testimonial Section Start -->
    <!--
    <section id="testimonial">
        <div class="container">
            <div class="row">
                <h1 class="section-title wow fadeInLeft animated align-left" data-wow-delay=".6s">Most <span>Popular Courses</span></h1>
                <div class="wow fadeInLeft animated margin-bottom20">50000 online courses available</div>
                <div class="responsive slide wow fadeInUp animated">
                    <div>
                        <div class="owl-item">
                            <article class="post post_mod-c clearfix">
                                <div class="entry-media">
                                    <div class="entry-thumbnail">
                                        <a href="javascript:void(0);">
                                            <img class="img-responsive" src="assets/img/1.jpg" width="370" height="250" alt="Foto"></a>
                                    </div>
                                    <div class="entry-hover"><a href="javascript:void(0);" class="post-btn btn btn-primary btn-effect">READ MORE</a></div>
                                </div>
                                <div class="entry-main">
                                    <h3 class="entry-title ui-title-inner"><a href="bigdata.html">Big Data</a></h3>
                                    <div class="entry-meta decor decor_mod-b"> <span class="entry-autor"> <span>By </span> <a class="post-link" href="javascript:void(0);">John Milton</a> </span> <span class="entry-date"><a href="javascript:void(0);">Dec 16, 2015</a></span> </div>
                                    <div class="entry-content">
                                        <p>CIOs are making Hadoop their platform of choice in 2016. For better career prospects, bigger job opportunities and financial growth, Hadoop is a must-know.</p>
                                    </div>
                                    <div class="entry-footer">
                                    <div class="box-comments"><a href="javascript:void(0);" class="margin-right20"><i class="icon stroke icon-Message">&#xf003;</i>25</a> <a href="javascript:void(0);"><i class="icon stroke icon-User">&#xf0f0;</i>65</a> </div>
                                        <a href="bigdata.html">Read More...</a>
                                        <ul class="rating">
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div>
                        <div class="owl-item">
                            <article class="post post_mod-c clearfix">
                                <div class="entry-media">
                                    <div class="entry-thumbnail">
                                        <a href="javascript:void(0);">
                                            <img class="img-responsive" src="assets/img/1.jpg" width="370" height="250" alt="Foto"></a>
                                    </div>
                                    <div class="entry-hover"><a href="javascript:void(0);" class="post-btn btn btn-primary btn-effect">READ MORE</a></div>
                                </div>
                                <div class="entry-main">
                                    <h3 class="entry-title ui-title-inner"><a href="pmp.html">PMP</a></h3>
                                                        <div class="entry-meta decor decor_mod-b"> <span class="entry-autor"> <span>By </span> <a class="post-link" href="javascript:void(0);">University of LIMS</a> </span> <span class="entry-date"><a href="javascript:void(0);">Dec 16, 2015</a></span> </div>
                                    <div class="entry-content">
                                        <p>This course is designed for persons who have on the job experience performing project management tasks, whether or not project manager is their formal job role, who are not certified project management professionals.</p>
                                    </div>
                                    <div class="entry-footer">
                                        <div class="box-comments"><a href="javascript:void(0);" class="margin-right20"><i class="icon stroke icon-Message">&#xf003;</i>25</a> <a href="javascript:void(0);"><i class="icon stroke icon-User">&#xf0f0;</i>65</a> </div>
                                        <a href="pmp.html">Read More...</a>
                                        <ul class="rating">
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div>
                        <div class="owl-item">
                            <article class="post post_mod-c clearfix">
                                <div class="entry-media">
                                    <div class="entry-thumbnail">
                                        <a href="javascript:void(0);">
                                            <img class="img-responsive" src="assets/img/1.jpg" width="370" height="250" alt="Foto"></a>
                                    </div>
                                    <div class="entry-hover"><a href="javascript:void(0);" class="post-btn btn btn-primary btn-effect">READ MORE</a></div>
                                </div>
                                <div class="entry-main">
                                    <h3 class="entry-title ui-title-inner"><a href="document-cloud-service.html">Document Cloud Service</a></h3>
                                                        <div class="entry-meta decor decor_mod-b"> <span class="entry-autor"> <span>By </span> <a class="post-link" href="javascript:void(0);">John Milton</a> </span> <span class="entry-date"><a href="javascript:void(0);">Dec 16, 2015</a></span> </div>
                                    <div class="entry-content">
                                        <p>Cloud is a new norm in IT now. To keep you updated on cutting edge technologies cloud platform awareness and knowledge is a must. Needless to.</p>
                                    </div>
                                    <div class="entry-footer">
                                    <div class="box-comments"><a href="javascript:void(0);" class="margin-right20"><i class="icon stroke icon-Message">&#xf003;</i>25</a> <a href="javascript:void(0);"><i class="icon stroke icon-User">&#xf0f0;</i>65</a> </div>
                                        <a href="document-cloud-service.html">Read More...</a>
                                        <ul class="rating">
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div>
                        <div class="owl-item">
                            <article class="post post_mod-c clearfix">
                                <div class="entry-media">
                                    <div class="entry-thumbnail">
                                        <a href="javascript:void(0);">
                                            <img class="img-responsive" src="assets/img/1.jpg" width="370" height="250" alt="Foto"></a>
                                    </div>
                                    <div class="entry-hover"><a href="javascript:void(0);" class="post-btn btn btn-primary btn-effect">READ MORE</a></div>
                                </div>
                                <div class="entry-main">
                                    <h3 class="entry-title ui-title-inner"><a href="database-cloud-service.html">Database Cloud Service</a></h3>
                                        <div class="entry-meta decor decor_mod-b"> <span class="entry-autor"> <span>By </span> <a class="post-link" href="javascript:void(0);">John Milton</a> </span> <span class="entry-date"><a href="javascript:void(0);">Dec 16, 2015</a></span> </div>
                                    <div class="entry-content">
                                        <p>Cloud is a new norm in IT now. To keep you updated on cutting edge technologies cloud platform awareness and knowledge is a must. Needless to...</p>
                                    </div>
                                    <div class="entry-footer">
                                        <div class="box-comments"><a href="javascript:void(0);" class="margin-right20"><i class="icon stroke icon-Message">&#xf003;</i>25</a> <a href="javascript:void(0);"><i class="icon stroke icon-User">&#xf0f0;</i>65</a> </div>
                                        <a href="database-cloud-service.html">Read More...</a>
                                        <ul class="rating">
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                    <div>
                        <div class="owl-item">
                            <article class="post post_mod-c clearfix">
                                <div class="entry-media">
                                    <div class="entry-thumbnail">
                                        <a href="javascript:void(0);">
                                            <img class="img-responsive"  src="assets/img/1.jpg" width="370" height="250"  alt="Foto"></a>
                                    </div>
                                    <div class="entry-hover"><a href="javascript:void(0);" class="post-btn btn btn-primary btn-effect">READ MORE</a></div>
                                </div>
                                <div class="entry-main">
                                    <h3 class="entry-title ui-title-inner"><a href="microsoft-dynamics-crm.html">Microsoft Dynamics CRM</a></h3>
                                                        <div class="entry-meta decor decor_mod-b"> <span class="entry-autor"> <span>By </span> <a class="post-link" href="javascript:void(0);">University of LIMS</a> </span> <span class="entry-date"><a href="javascript:void(0);">Dec 16, 2015</a></span> </div>
                                    <div class="entry-content">
                                        <p>Microsoft Dynamics Customer Relationship Management (CRM) is a business solution to help develop leads, nurture contacts, track your sales, and keep your customers happy. About. Of course you have customers-every business does.</p>
                                    </div>
                                    <div class="entry-footer">
                                        <div class="box-comments"><a href="javascript:void(0);" class="margin-right20"><i class="icon stroke icon-Message">&#xf003;</i>25</a> <a href="javascript:void(0);"><i class="icon stroke icon-User">&#xf0f0;</i>65</a> </div>
                                        <a href="microsoft-dynamics-crm.html">Read More...</a>
                                        <ul class="rating">
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star"></i></li>
                                            <li><i class="icon fa fa-star-o"></i></li>
                                        </ul>
                                    </div>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->
    <!-- Testimonial Section End -->

    <!-- Clients Section Start -->
    <!--<section id="clients">
        <div class="container">
            <div class="row">

                <div id="clients-carousel" class="owl-carousel owl-theme">
                    <div class="item wow fadeInLeft animated" data-wow-delay=".9s">
                        <a href="#">
                            <img src="assets/img/clients/img1.png" alt=""></a>
                    </div>
                    <div class="item wow fadeInLeft animated" data-wow-delay=".9s">
                        <a href="#">
                            <img src="assets/img/clients/img2.png" alt=""></a>
                    </div>
                    <div class="item wow fadeInRight animated" data-wow-delay=".9s">
                        <a href="#">
                            <img src="assets/img/clients/img3.png" alt=""></a>
                    </div>
                    <div class="item wow fadeInRight animated" data-wow-delay=".9s">
                        <a href="#">
                            <img src="assets/img/clients/img4.png" alt=""></a>
                    </div>
                    <div class="item wow fadeIn animated">
                        <a href="#">
                            <img src="assets/img/clients/img5.png" alt=""></a>
                    </div>
                    <div class="item wow fadeIn animated">
                        <a href="#">
                            <img src="assets/img/clients/img1.png" alt=""></a>
                    </div>
                    <div class="item wow fadeIn animated">
                        <a href="#">
                            <img src="assets/img/clients/img2.png" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!-- Clients Section End -->



    <!-- Blog Section Start -->
    <!--<section id="blog">
        <div class="container">
            <div class="row">
                <h1 class="section-title wow fadeInLeft animated" data-wow-delay=".6s">Alumni speak</h1>

                <div class="autoplay margin-top50">
                    <div>
                        <ul class="tab">
                            <li>
                                <img src="assets/img/img1.png" /></li>
                        </ul>
                        <ul class="tab_cont">
                            <li>
                                <div class='cont'>
                                    <h2>Chuck Scro</h2>
                                    <p>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry."</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="tab">
                            <li>
                                <img src="assets/img/img2.png" /></li>
                        </ul>
                        <ul class="tab_cont">
                            <li>
                                <div class='cont'>
                                    <h2>Chuck Scro</h2>
                                    <p>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry."</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="tab">
                            <li>
                                <img src="assets/img/img3.png" /></li>
                        </ul>
                        <ul class="tab_cont">
                            <li>
                                <div class='cont'>
                                    <h2>Chuck Scro</h2>
                                    <p>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry."</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="tab">
                            <li>
                                <img src="assets/img/img4.png" /></li>
                        </ul>
                        <ul class="tab_cont">
                            <li>
                                <div class='cont'>
                                    <h2>Chuck Scro</h2>
                                    <p>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry."</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </section>-->
    <!-- Blog Section Start -->

@endsection