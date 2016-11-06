@extends('layouts.main')
@section('title', 'Events')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/inner.css')}}">
    <!-- Header Section Start -->
    <div id="inner-header">
        <div class="container">
            <div class="col-md-12 top-header">
                <div class="logo-menu">
                    <div class="logo pull-left wow fadeInDown animated" data-wow-delay=".2s">
                        <h1 class="ui-title-page">Recruiters</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <!-- Header Section End -->
    <div class="section-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="wrap-breadcrumb clearfix">
                        <ol class="breadcrumb">
                            <li><a href="{{route("/")}}"><i class="icon">&#xf015;</i></a></li>
                            <li class="active">All stuff related to recruiters module.</li>
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
                    <div class="col-md-8">
                        <img src="{{asset('uploads/recruitment.jpg')}}" />
                    </div>
                </div><!-- end row -->
            </div><!-- end container -->
        </section><!-- end about -->
    </main>
@endsection