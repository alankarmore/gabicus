@extends('layouts.account')
@section('title', "$metaTitle")
@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/inner.css')}}">
    <div class="container userprofile">
{{--        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="toplinks">
                <p>You are here :</p>
                <ul>
                    <li class="first"><a href="{{route('/')}}">Home</a></li>
                    <li>Profile</li>
                </ul>
            </div>
        </div>--}}
        <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-10 margin-bottom20 nopadding-right">
                    <div class="page-header">
                        <h3 class="reviews">Basic Information</h3>
                    </div>
                    <span class="pull-right"><a class="btn btn-default" href="{{route('user.profile.edit')}}">Edit</a></span>
            </div>
        </div>
        @include('partials.error')
        <form action="{{route('user.profile.edit')}}" method="POST" id="signupForm">
            <div class="row">
                <div class="col-md-10 col-sm-10 col-xs-10 margin-bottom20 nopadding-right">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="row">
                        <div class="col-md-4">
                            @if($user->profile_image != null)
                            <img class="profile-image" src="{{asset('uploads/user')}}/{{$user->profile_image}}">
                            @else
                                <img class="profile-image" src="{{asset('uploads/user/default.png')}}">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="col-md-2 control-label">Name:</label>
                                <label class="col-md-10 control-label pull-left">{{ucwords($user->first_name." ".$user->last_name)}}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 control-label">Email:</label>
                                <label class="col-md-10 control-label pull-left">{{$user->email}}</label>
                            </div>
                            @if($user->gender != NULL)
                            <div class="form-group">
                                <label class="col-md-2 control-label">Gender:</label>
                                <label class="col-md-10 control-label pull-left">{{strtoupper($user->gender)}}</label>
                            </div>
                            @endif
                            @if($user->birth_date != NULL)
                            <div class="form-group">
                                <label class="col-md-2 control-label">DOB:</label>
                                <label class="col-md-10 control-label pull-left">{{date("d F Y", strtotime($user->birth_date))}}</label>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($user->phone_no!=NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Phone:</label>
                                    <label class="col-md-10 control-label pull-left">{{$user->phone_no}}</label>
                                </div>
                            @endif
                            @if($user->mobile_no != NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Mobile:</label>
                                    <label class="col-md-10 control-label pull-left">{{$user->mobile_no}}</label>
                                </div>
                            @endif
                            @if($user->brith_date != NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Birth Date:</label>
                                    <label class="col-md-10 control-label pull-left">{{date("d F Y", strtotime($user->birth_date))}}</label>
                                </div>
                            @endif
                            @if($user->state_id != NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">State:</label>
                                    <label class="col-md-10 control-label pull-left">{{ucwords($user->state->name)}}</label>
                                </div>
                            @endif
                                @if($user->city_id != NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">City:</label>
                                    <label class="col-md-10 control-label pull-left">{{ucwords($user->city->name)}}</label>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            @if($user->role->role_id == 3)
            <div class="row">
                <div class="col-md-10 col-sm-10 col-xs-10 nopadding-right">
                    <div class="page-header">
                        <h3 class="reviews">Academic Information</h3>
                    </div>
                    <span class="pull-right"><a class="btn btn-default" href="{{route('user.profile.edit')}}">Edit</a></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-sm-10 col-xs-10 margin-bottom20 nopadding-right">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="row">
                        <div class="col-md-6">
                            @if($user->student->college_state_id != NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">State:</label>
                                    <label class="col-md-10 control-label pull-left">{{ucwords($user->student->state->name)}}</label>
                                </div>
                                <div class="clearfix"></div>
                            @endif
                            @if($user->student->university_name != NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">University:</label>
                                    <label class="col-md-10 control-label pull-left">{{ucwords($user->student->university_name)}}</label>
                                </div>
                                <div class="clearfix"></div>
                            @endif
                            @if($user->student->education_degree_id != NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Degree:</label>
                                    <label class="col-md-10 control-label pull-left">{{ucwords($user->student->degree->name)}}</label>
                                </div>
                                <div class="clearfix"></div>
                            @endif
                            @if($user->student->passing_month != NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Month:</label>
                                    <label class="col-md-10 control-label pull-left">{{$user->student->passing_month}}</label>
                                </div>
                                <div class="clearfix"></div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            @if($user->student->college_city_id != NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">City:</label>
                                    <label class="col-md-10 control-label pull-left">{{ucwords($user->student->city->name)}}</label>
                                </div>
                                <div class="clearfix"></div>
                            @endif
                            @if($user->student->college_name != NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">College:</label>
                                    <label class="col-md-10 control-label pull-left">{{ucwords($user->student->college_name)}}</label>
                                </div>
                                <div class="clearfix"></div>
                            @endif
                            @if($user->student->education_course_type_id != NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Degree:</label>
                                    <label class="col-md-9 pull-left">{{ucwords($user->student->course->name)}}</label>
                                </div>
                                <div class="clearfix"></div>
                            @endif
                            @if($user->student->passing_year != NULL)
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Year:</label>
                                    <label class="col-md-10 control-label pull-left">{{$user->student->passing_year}}</label>
                                </div>
                                <div class="clearfix"></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            @endif
        </form>
    </div>
@endsection