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
                <div class="col-md-8">
                    @if (Session::has('message'))  <div class="alert alert-success">{{ Session::get('message') }} </div> @endif 
                        <div class="form_wrapper_drp_qry sticky_element">
                            <div class="webengage_close"></div>
                            <form class="course-list-drop-query" action="{{route('post-teach-with-us')}}" method="POST" id="teachwithusForm"  enctype="multipart/form-data">
                                <div class="placeholder_wrap">
                                    <input type="text" name="name" id="name" class="form-control" required="required" placeholder="Name*" value="{{Input::old('name') ? Input::old('name') : ''}}">  
                                    <span id="error-tech-with-us-name" style="color:red;" class="errorMessage">{{ $errors->first('name') }}</span>
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
                                    <input type="email" name="email" id="email" class="form-control" required="required" placeholder="Email*" value="{{Input::old('email') ? Input::old('email') : ''}}">
                                    <span id="error-tech-with-us-email" style="color:red;" class="errorMessage">{{ $errors->first('email') }}</span>
                                </div>
                                <div class="placeholder_wrap">
                                    <input type="text" name="qualification" id="qualification" class="form-control" required="required" placeholder="Qualification*" value="{{Input::old('qualification') ? Input::old('qualification') : ''}}">
                                    <span id="error-tech-with-us-qualification" style="color:red;" class="errorMessage">{{ $errors->first('qualification') }}</span>
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
                                    <textarea name="itexperience" id="itexperience" rows="2" class="form-control" required="required" placeholder="ITExperience*">{{Input::old('itexperience') ? Input::old('itexperience') : ''}}</textarea>
                                    <span id="error-tech-with-us-itexperience" style="color:red;" class="errorMessage">{{ $errors->first('itexperience') }}</span>
                                </div>                                 
                                <span class="">&nbsp;</span>        
                                <div class="placeholder_wrap list_query">
                                    <textarea name="training_courses" id="training_courses" rows="2" class="form-control" required="required" placeholder="Course on which you can conduct trainings*">{{Input::old('training_courses') ? Input::old('training_courses') : ''}}</textarea>
                                    <span id="error-tech-with-us-training_courses" style="color:red;" class="errorMessage">{{ $errors->first('training_courses') }}</span>
                                </div> 
                                <span class="">&nbsp;</span>   
                                <div class="placeholder_wrap list_query">
                                    <textarea name="message" id="message" rows="2" class="form-control" required="required" placeholder="Your Query*">{{Input::old('message') ? Input::old('message') : ''}}</textarea>
                                    <span id="error-tech-with-us-message" style="color:red;" class="errorMessage">{{ $errors->first('message') }}</span>
                                </div>
                                <span class="">&nbsp;</span>  
                                <div class="placeholder_wrap">
                                    <input type="file" name="resume" id="resume" class="" required="required" placeholder="Resume*" />
                                    <span id="error-tech-with-us-contact_number" style="color:red;" class="errorMessage">{{ $errors->first('resume') }}</span>
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