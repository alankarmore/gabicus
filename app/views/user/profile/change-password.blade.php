@extends('layouts.main')
@section('title', "$metaTitle")
@section('content')
    <div class="container userprofile">
        {{--        <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="toplinks">
                        <p>You are here :</p>
                        <ul>
                            <li class="first"><a href="{{route('/')}}">Home</a></li>
                            <li ><a href="{{route('user.profile.view')}}">Profile</a></li>
                            <li >Edit Profile</li>
                        </ul>
                    </div>
                </div>--}}
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1" id="logout">
                <div class="page-header">
                    <h3 class="reviews">Change Password</h3>
                </div>
            </div>
        </div>
        @include('partials.error')
        <form action="{{route('user.password')}}" method="POST" id="changepassword">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="" for="exampleInputEmail3">Current Password</label>
                                <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password" tabindex="1">
                                @if($errors->first('current_password'))<p class="error">{{$errors->first('current_password')}}</p>@endif
                            </div>
                            <div class="form-group">
                                <label class="" for="email">New Password</label>
                                <input type="password" class="form-control" id="password"  name="password" placeholder="Password" tabindex="2" >
                            </div>
                            <div class="form-group">
                                <label>Confirm Password:</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Password Confirmation" tabindex="3"/>
                                @if($errors->first('password_confirmation'))<p class="error">{{$errors->first('password_confirmation')}}</p>@endif
                            </div>
                            <div class="form-group">
                                <div class="col-sm-5">
                                    <input type="submit" class="btn btn-block btn-primary text-uppercase" value="Save" tabindex="17">
                                </div>
                                <div class="col-sm-5">
                                    <p class="change_link">
                                        <a href="{{route('user.profile.view')}}" class="btn btn-block btn-primary text-uppercase" tabindex="18"> Cancel </a>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('page-script')
    <script>
        $(function(){
            $("#current_password").focus();
        });
    </script>
@endsection
