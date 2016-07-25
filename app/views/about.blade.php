@extends('layouts.main')
@section('title', 'Contact Us')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/inner.css')}}" />
    <!-- Header Section Start -->
        <div id="header">
            <div class="container">
                <div class="col-md-12 top-header">
                    <div class="logo-menu">
                        <div class="logo pull-left wow fadeInDown animated" data-wow-delay=".2s">
                            <h1 class="ui-title-page">ABOUT US</h1>
                        </div>
                        @include('partials.searchmenu')
                    </div>
                    @include('partials.sidebar')         
                </div>
            </div>
        </div>    
    <!-- Header Section End -->

    <main class="main-content">
            <section class="about rtd">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="about__title">welcome to <strong>GABICUS</strong></h2>
                            <p>Gabicus Edutech India Pvt. Ltd. is a premier Information Technology & Education solutions provider company working in the field of Software Development, Maintenance, Business Process Outsourcing, Resource outsourcing, Education & Training. Based out of India we are equipped with the best resources to handle the most complex projects from offshore.</p>
                            <p>Our resource base consists of Engineers and Analysts from premier institutes of India with varied experience in top companies across the globe. Our Board of Directors has long experience in establishing business for Major IT companies in India.</p>
                            <p>In Gabicus, we have zero tolerance to un-ethical and ill-legal behavior. We strongly believe, long term vision can not be compromised for short term gains. Each employee in our organization is specifically trained to deal with situations in a most ethical and transparent manner.  </p>
                            <h3 class="about__title-inner">We Offer <strong>Best Courses !</strong></h3>
                            <ul class="list-mark">
                                <li>BIG DATA</li>
                                <li>PMP</li>
                                <li>Document Cloud Service</li>
                                <li>Database Cloud Service</li>
                                <li>Microsoft Dynamics CRM</li>
                            </ul>

                        </div><!-- end col -->

                    </div><!-- end row -->
                </div><!-- end container -->
            </section><!-- end about -->


            <!--            <div class="section-advantages_mod-a">
                                            <div class="container">
                                                    <div class="row">
                                                            <div class="col-xs-12">
                                                                    <ul class="advantages advantages_mod-c list-unstyled">
                                                                            <li class="advantages__item">
                                                                                    <span class="advantages__icon decor decor_mod-a"><i class="icon">&#xf0c0;</i></span>
                                                                                    <span class="advantages__title ui-title-inner">SKILLED FACULTY</span>
                                                                            </li>
                                                                            <li class="advantages__item">
                                                                                    <span class="advantages__icon decor decor_mod-a"><i class="icon">&#xf091;</i></span>
                                                                                    <span class="advantages__title ui-title-inner">HIGHest RATED</span>
                                                                            </li>
                                                                            <li class="advantages__item">
                                                                                    <span class="advantages__icon decor decor_mod-a"><i class="icon">&#xf0ac;</i></span>
                                                                                    <span class="advantages__title ui-title-inner">GLOBALLY RECOGNIZED</span>
                                                                            </li>
                                                                            <li class="advantages__item">
                                                                                    <span class="advantages__icon decor decor_mod-a"><i class="icon">&#xf109;</i></span>
                                                                                    <span class="advantages__title ui-title-inner">ONLINE TRAINING</span>
                                                                            </li>
                                                                    </ul>
                                                            </div><!-- end col -->
            <!--</div>--><!-- end row -->
            <!--</div>--><!-- end container -->
            <!--</div>-->-->
            <!-- end section-advantages -->
        </main>
@endsection
