@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login_wrapper">
                <div id="" class="form">
                    <section class="form_content">
                        <form action="{{route('user.signup')}}" method="POST" novalidate="">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <h1>Create Your Account</h1>
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-compass"></i></span>
                                <select class="form-control" id="user_type" name="user_type" required="required">
                                    <option value="">Select Profession</option>
                                    <option value="student">Student</option>
                                    <option value="employee">Employee</option>
                                    <option value="recruiter">Recruiter</option>
                                    <option value="none">None of the above</option>
                                </select>
                            </div>
                            @if($errors->first('user_type'))<p class="error">{{$errors->first('user_type')}}</p>@endif
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-user"></i></span>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required="" />
                            </div>
                            @if($errors->first('first_name'))<p class="error">{{$errors->first('first_name')}}</p>@endif
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-user"></i></span>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required="" />
                            </div>
                            @if($errors->first('first_name'))<p class="error">{{$errors->first('last_name')}}</p>@endif
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            @if($errors->first('first_name'))<p class="error">{{$errors->first('email')}}</p>@endif
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-key"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            @if($errors->first('password'))<p class="error">{{$errors->first('password')}}</p>@endif
                            <br/>
                            <div>
                                <button type="submit" id="submit" class="btn btn-green">Sing Up</button>
                            </div>
                            <div class="clearfix"></div>
                            <br/>
                            <div class="separator">
                                <p class="change_link">Already a member ?
                                    <a href="{{route('user.signin')}}" class="to_register"> Log in </a>
                                </p>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
