@extends('layouts.main')
@section('title', 'Contact Us')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/inner.css')}}" />
    <!-- Header Section Start -->
    <div id="header" class="position-relative">
        <div class="container">
            <div class="col-md-12 top-header">
                <div class="logo-menu">
                    <div class="logo pull-left wow fadeInDown animated" data-wow-delay=".2s">
                        <h1 class="ui-title-page">CONTACT US</h1>
                    </div>
                    @include('partials.searchmenu')
                </div>
                @include('partials.sidebar')
            </div>
        </div>
    </div>
    <!-- Header Section End -->

    <div class="section-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="wrap-breadcrumb clearfix">
                        <ol class="breadcrumb">
                            <li><a href="{{route('/')}}"><i class="icon">&#xf015;</i></a></li>
                            <li class="active">Contact Us</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
@endsection
