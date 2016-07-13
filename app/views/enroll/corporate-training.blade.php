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
                    <h1 class="ui-title-page">Corporate Training </h1>
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
                        <li class="active">Please fill below form for corporate training.</li>
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
                    @if (Session::has('message'))  <div class="alert alert-success">{{ Session::get('message') }} </div> @endif 
                        <div class="form_wrapper_drp_qry sticky_element">
                            <div class="webengage_close"></div>
                            <form class="course-list-drop-query" action="{{route('post-corporate-training')}}" method="POST" id="teachwithusForm"  novalidate="">
                                <div class="placeholder_wrap">
                                    <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Name of the Organization*" value="{{Input::old('name') ? Input::old('name') : ''}}">  
                                    <span id="error-tech-with-us-name" style="color:red;" class="errorMessage">{{ $errors->first('name') }}</span>
                                </div>
                                <div class="placeholder_wrap" style="margin-bottom:5px;">
                                    <select name="team_members" id="team_members" class="form-control">
                                        <option value="">Number of team members for whom training is required</option>
                                        @for($index = 1 ; $index <= 100; $index++)
                                        <option value="{{$index}}">{{$index}}</option>
                                        @endfor
                                        <option value="100+">100+</option>
                                    </select>
                                    <span id="error-enroll-age" style="color:red;" class="errorMessage"></span>
                                </div>                                
                                <div class="placeholder_wrap">
                                    <input type="email" name="email" id="email" class="form-control" required="required" placeholder="Email*" value="{{Input::old('email') ? Input::old('email') : ''}}">
                                    <span id="error-tech-with-us-email" style="color:red;" class="errorMessage">{{ $errors->first('email') }}</span>
                                </div> 
                                <div class="placeholder_wrap">
                                    <input type="text" name="contact_number" id="contact_number" class="form-control" required="required" placeholder="Contact Number*" value="{{Input::old('contact_number') ? Input::old('contact_number') : ''}}">
                                    <span id="error-tech-with-us-contact_number" style="color:red;" class="errorMessage">{{ $errors->first('contact_number') }}</span>
                                </div>  
                                <div class="placeholder_wrap">
                                    <input type="text" name="location" id="location" class="form-control" required="required" placeholder="Location*" value="{{Input::old('location') ? Input::old('location') : ''}}">
                                    <span id="error-tech-with-us-contact_number" style="color:red;" class="errorMessage">{{ $errors->first('location') }}</span>
                                </div>  
                                <span class="">&nbsp;</span>                                        
                                <div class="placeholder_wrap list_query">
                                    <textarea name="courses_required" id="courses_required" rows="2" class="form-control" required="required" placeholder="Course on which training is required*">{{Input::old('courses_required') ? Input::old('courses_required') : ''}}</textarea>
                                    <span id="error-tech-with-us-training_courses" style="color:red;" class="errorMessage">{{ $errors->first('courses_required') }}</span>
                                </div> 
                                <div class="checkbox">
                                    <label>By submitting this form I agree to be contacted on email and phone</label>
                                </div> 
                                <br>
                                <button type="submit" class="btn btn-info drop-query-submit" id="tech-submit">Submit</button>

                            </form>
                        </div>               
                </div>
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end about -->
</main>
@endsection