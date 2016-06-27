@extends('layouts.main')
@section('title', 'Gabicus India')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/inner.css')}}">
<!-- Header Section Start -->
<div id="inner-header">
    <div class="container">
        <div class="col-md-12 top-header">
            <div class="logo-menu">
                <div class="logo pull-left wow fadeInDown animated" data-wow-delay=".2s">
                    <h1 class="ui-title-page">Teach with us </h1>
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
                        <li><a href="{{route("/")}}"><i class="icon">&#xf015;</i></a></li>
                        <li class="active">Please fill below form to teach with us.</li>
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
                <div class=" col-md-8">
                        <div class="form_wrapper_drp_qry sticky_element">
                            <div class="webengage_close"></div>
                            <form class="course-list-drop-query" action="" method="POST" id="queryForm">
                                <div class="placeholder_wrap">
                                    <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Name*">  
                                    <span id="error-query-name" style="color:red;" class="errorMessage"></span>
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
                                    <input type="email" name="email" id="email" class="form-control" required="required" placeholder="Email*">
                                    <span id="error-query-email" style="color:red;" class="errorMessage"></span>
                                </div>
                                <div class="placeholder_wrap">
                                    <input type="text" name="qualification" id="qualification" class="form-control" required="required" placeholder="Qualification*">
                                    <span id="error-query-email" style="color:red;" class="errorMessage"></span>
                                </div>
                                <div class="placeholder_wrap">&nbsp;</div>        

                                <div class="placeholder_wrap list_query">
                                    <textarea name="message" id="message" rows="2" class="form-control " placeholder="Your Query*"></textarea>
                                    <span id="error-query-message" style="color:red;" class="errorMessage"></span>
                                </div>

                                <div>
                                    <div>Looking for a training for </div>
                                    <div class="radio">
                                        <label><input type="radio" name="training_for" checked="checked" value="0">My Self</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="training_for" value="1">My team/ Organisation</label>
                                    </div>
                                </div>
                                <div class="checkbox">
                                    <label>By submitting this form I agree to be contacted on email and phone</label>
                                </div> 
                                <br>
                                <button type="submit" class="btn btn-info drop-query-submit" id="query-submit">Submit</button>

                            </form>
                        </div>               
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end about -->
</main>
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