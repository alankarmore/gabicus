@extends('layouts.main')
@section('title', $course->title)
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/inner.css')}}">
<!-- Header Section Start -->
    <div id="header" class="container">
        <div class="col-md-12 top-header">
            <div class="logo-menu">
                <div class="logo pull-left wow fadeInDown animated" data-wow-delay=".2s">
                    <h1 class="ui-title-page">{{ucwords($course->title)}}</h1>
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
                        <li class="active">{{ucwords($course->title)}}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<div class="inner-banner">
    <div class="container">
        <div class="pull-left">
            <div class="col-sm-10" style="margin-top: 15px;">
                <span class="pull-left"><i class="glyphicon glyphicon-globe"></i></span>:<span><b>{{ucfirst($course->location)}}</b></span>
                <span style="margin-left: 15px;">&#8377;</span>:<span><b>{{ucfirst($course->fees)}}/-</b></span>
            </div>
            <a href="javascript:void(0);" class="enroll-btn" data-toggle="modal" data-target="#myModal" data-backdrop="static" data-keyboard="false">Enroll Now</a>
        </div>
        <div class="pull-right">
            <img src="{{route('getimage',array('folder'=> 'course','file' => $course->image_name,'width' => 565,'height' => 180))}}" /></div>
    </div>
</div>

<main class="main-content">
    <section class="about rtd">
        <div class="container">
            <div class="row">
                <div class=" col-md-8">{{$course->description}}</div>
                @include('partials.queryform')

            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end about -->
</main>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form class="course-list-drop-query" action="" method="POST" id="enrollForm" novalidate="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Enroll With Us.</h4>
                </div>
                <div class="modal-body">
                    <div class="form_wrapper_drp_qry sticky_element">
                        <div class="webengage_close"></div>
                        <h6>To Enroll yourself kindly fill below form.</h6>

                        <div class="placeholder_wrap">
                            <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Name*">
                            <span id="error-enroll-name" style="color:red;" class="errorMessage"></span>
                        </div>
                        <div class="placeholder_wrap">
                            <input type="email" name="email" id="email" class="form-control" required="required" placeholder="Email*">
                            <span id="error-enroll-email" style="color:red;" class="errorMessage"></span>
                        </div>
                        <div class="placeholder_wrap">
                            <input type="text" name="qualification" id="qualification" class="form-control" required="required" placeholder="Your Highest Qualification*">
                            <span id="error-enroll-qualification" style="color:red;" class="errorMessage"></span>
                        </div>
                        <div class="placeholder_wrap" style="margin-bottom:5px;">
                            <select name="age" id="age" class="form-control" placeholder="Your Age*">
                                <option value="1">Your Age</option>
                                @for($index = 1 ; $index <= 100; $index++)
                                @if($index > 1)
                                <option value="{{$index}}">{{$index}} Years</option>
                                @else
                                <option value="{{$index}}">{{$index}} Year</option>
                                @endif
                                @endfor
                            </select>
                            <span id="error-enroll-age" style="color:red;" class="errorMessage"></span>
                        </div>
                        <div class="placeholder_wrap">
                            <textarea name="experience" id="experience" rows="2" class="form-control " placeholder="IT Experience (if any)" style="position: static;"></textarea>
                            <span id="error-enroll-experience" style="color:red;" class="errorMessage"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="course" id="course" value="{{$course->id}}" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="enroll-submit">Enrolll Me!</button>
                </div>
            </div>
        </div>
    </form>
</div>
@section('page-script')
<script>
    $(function () {
        $("#enrollForm").submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: '{{route("post-enroll")}}',
                data: $(this).serialize(),
                dataType: "JSON",
                type: "POST",
                beforeSend: function () {
                    $("#enroll-submit").html('Enrolling you.....');
                },
                success: function (msg) {
                    res = msg;
                },
                complete: function () {
                    if (res.success) {
                        $("#enrollForm")[0].reset();
                        $(".errorMessage").html('');
                        $("#enroll-submit").html('Enroll Me!');
                        alert(res.success);
                    } else {
                        for (var key in res) {
                            $("#error-enroll-" + key).html(res[key]);
                        }
                    }
                    $("#enroll-submit").html('Enroll Me!');
                }
            });
        });
    });
</script>
@endsection
@endsection
