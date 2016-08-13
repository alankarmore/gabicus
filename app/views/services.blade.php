@extends('layouts.main')
@section('title', 'Services')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/inner.css')}}" />
    <div id="header">
        <div class="container">
            <div class="col-md-12 top-header">
                <div class="logo-menu">
                    <div class="logo pull-left wow fadeInDown animated" data-wow-delay=".2s">
                        <h1 class="ui-title-page">Services</h1>
                    </div>
                        @include('partials.searchmenu')
                    </div>
                    @include('partials.sidebar')
<!-- navigation End -->
            </div>
            <!-- </div>-->
        </div>
    </div>
    <!-- Header Section End -->
    <div class="section-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="wrap-breadcrumb clearfix">
                        <ol class="breadcrumb">
                            <li><a href="javascript:void(0);"><i class="icon">&#xf015;</i></a></li>
                            <li class="active">Services</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <main class="main-content">
                    <section class="about rtd">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    {{$menu->description}}
                                </div>
                                <!-- end col -->
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
                        <!--</div><!-- end container -->
                    <!--</div>-->
        <!-- end section-advantages -->
                </main>
@endsection
@endsection
