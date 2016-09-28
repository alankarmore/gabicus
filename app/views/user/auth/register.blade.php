@extends('layouts.main')
@section('page-css')
    <link href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/validator/screen.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login_wrapper">
                <div id="" class="form">
                    <section class="form_content">
                        <form action="{{route('user.signup')}}" method="POST" novalidate="" id="signupForm">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <h1>Create Your Account</h1>
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-compass"></i></span>
                                <select class="form-control" id="user_type" name="user_type" >
                                    <option value="">Select Profession</option>
                                    <option value="student">For Students - College Students</option>
                                    <option value="employee">For Employee - Professionals</option>
                                    <option value="recruiter">Recruiter</option>
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
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            @if($errors->first('first_name'))<p class="error">{{$errors->first('email')}}</p>@endif
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-key"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            @if($errors->first('password'))<p class="error">{{$errors->first('password')}}</p>@endif
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-users"></i></span>
                                <select class="form-control" id="gender" name="gender" >
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-calendar"></i></span>
                                <input name="birth_date" data-autoclose="true" id="birth_date" class="form-control datepicker"  data-provide="datepicker" readonly="readonly" data-date-format="yyyy-mm-dd"/>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-home"></i></span>
                                <input type="text" name="state" id="state" class="form-control"  placeholder="State"/>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-home"></i></span>
                                <input type="text" name="city" id="city" class="form-control"  placeholder="City"/>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-phone"></i></span>
                                <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone Number"/>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon" class="errorMessage"><i class="fa fa-mobile"></i></span>
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control"  placeholder="Mobile Number"/>
                            </div>
                            <br/>
                            <div>
                                <button type="submit" id="submit" class="btn btn-green">Sign Up</button>
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
@section('page-script')
    <script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/validator/jquery.validate.min.js')}}"></script>
    <script>
        $('.datepicker').datepicker();

        $().ready(function() {
            $.validator.addMethod('phone', function (value) {
                if(value!=''){
                    return /^\d{8,12}$/.test(value);
                }else{
                    return true;
                }
            }, 'Phone number should be number and in between 8 to 12 digits');
            $.validator.addMethod('mobile', function (value) {
                if(value!=''){
                    return /^\d{10}$/.test(value);
                }else{
                    return true;
                }
            }, 'Mobile number should be number and it should be 10 digits');
            // validate signup form on keyup and submit
            $("#signupForm").validate({
                rules: {
                    user_type:{
                        required: true,
                    },
                    first_name: {
                        required: true,
                        maxlength:255,
                    },
                    last_name: {
                        required: true,
                        maxlength:255,
                    },
                    email: {
                        required: true,
                        email: true,
                        remote: {
                            url: "{{route('user.confirm.email')}}",
                            type: "GET",
                            data: {
                                email: function() {
                                    return $("#email").val();
                                }
                            }
                        }
                    },
                    password:{
                        required: true,
                        maxlength:30,
                    },
                    birth_date:"required",
                    state:{
                        required: true,
                        maxlength:150,
                    },
                    city:{
                        required: true,
                        maxlength:150,
                    },
                    phone_no:{
                        phone : true,
                    },
                    mobile_no:{
                        required: true,
                        mobile:true,
                    },
                },
                messages: {
                    email:{
                        remote:"Email id already used",
                    }
                }
            });
        });
    </script>
@endsection
