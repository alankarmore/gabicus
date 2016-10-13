@extends('layouts.main')
@section('page-css')
    <link href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/plugins/validator/screen.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1" id="logout">
            <div class="page-header">
                <h3 class="reviews">Create Your Account</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <form action="{{route('user.signup')}}" method="POST" id="signupForm">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail3">First Name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" tabindex="1">
                            @if($errors->first('first_name'))<p class="error">{{$errors->first('first_name')}}</p>@endif
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="email">Email</label>
                            <input type="email" class="form-control" id="email"  name="email" placeholder="Email" tabindex="3">
                            @if($errors->first('email'))<p class="error">{{$errors->first('email')}}</p>@endif
                        </div>                        
                        <div class="form-group">
                            <label class="sr-only" for="user_type">Select Profession</label>
                            <select class="form-control" id="user_type" name="user_type" tabindex="5">
                                <option value="">Select Profession</option>
                                <option value="student">Student</option>
                                <option value="employee">Employee</option>
                                <option value="recruiter">Recruiter</option>
                            </select>
                            @if($errors->first('user_type'))<p class="error">{{$errors->first('user_type')}}</p>@endif
                        </div>    
                        <div class="form-group">
                            <label class="sr-only" for="state">State</label>
                            <select class="form-control" id="state" name="state" tabindex="8">
                                <option value="">Select State</option>
                                @if($states)
                                @foreach($states as $state)
                                    <option value="{{$state->id}}">{{ucfirst($state->name)}}</option>
                                @@endforeach
                                @endif
                            </select>
                            @if($errors->first('state'))<p class="error">{{$errors->first('state')}}</p>@endif
                        </div>     
                       <div class="form-group">
                            <label class="sr-only" for="phone_no">Phone Number</label>
                            <input type="text" class="form-control" id="phone_no"  name="phone_no" placeholder="Phone Number" tabindex="10">
                             @if($errors->first('phone_no'))<p class="error">{{$errors->first('phone_no')}}</p>@endif
                        </div>                        
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword3">Last Name</label>
                            <input type="text" class="form-control" id="last_name"  name="last_name" placeholder="Last Name"  tabindex="2">
                            @if($errors->first('last_name'))<p class="error">{{$errors->first('last_name')}}</p>@endif
                        </div>    
                        <div class="form-group">
                            <label class="sr-only" for="gender">Select Gender</label>
                            <select class="form-control" id="gender" name="gender" tabindex="4">
                                <option value="">Select Gender</option>
                                <option value="male" selected="selected">Male</option>
                                <option value="female">Female</option>
                            </select>
                            @if($errors->first('gender'))<p class="error">{{$errors->first('gender')}}</p>@endif
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="password">Password</label>
                            <input type="password" class="form-control" id="password"  name="password" placeholder="Password" tabindex="6">
                            @if($errors->first('password'))<p class="error">{{$errors->first('password')}}</p>@endif
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="city">City</label>
                            <select class="form-control" id="city" name="city" tabindex="9">
                                <option value="">City</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                            @if($errors->first('city'))<p class="error">{{$errors->first('city')}}</p>@endif
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="phone_no">Phone Number</label>
                            <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile Number" tabindex="11">
                             @if($errors->first('mobile_no'))<p class="error">{{$errors->first('mobile_no')}}</p>@endif
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-md-offset-2 action-row">
                    <div class="form-group">
                        <div class="col-sm-5">
                            <input type="submit" class="btn btn-block btn-primary text-uppercase" value="Save"  tabindex="12">
                        </div>
                        <div class="separator col-md-7">
                            <p class="change_link">Already a member ?
                                <a href="{{route('user.signin')}}" class="to_register"> Log in </a>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>
@section('page-script')
    <script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/plugins/validator/jquery.validate.min.js')}}"></script>
    <script>
        $(function(){
            var route = '{{route("get-cities")}}';
            $(document).on("change","#state",function(){
                $.ajax({
                    url:route,
                    type:"POST",
                    data:{'stateId':$(this).val()},
                    dataType:"JSON",
                    beforeSend:function(){

                    },
                    success:function(msg){
                        res = msg;
                    },
                    complete:function() {
                        if(res.valid && res.response != null) {
                            $("#city").html(res.response);
                        } else {
                            $("#city").html('<option value="">Select City</option>');
                        }
                    }
                });
            });
        });
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
                        required: true
                    },
                    first_name: {
                        required: true,
                        maxlength:255
                    },
                    last_name: {
                        required: true,
                        maxlength:255
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
                        maxlength:30
                    },
                    birth_date:"required",
                    state:{
                        required: true
                    },
                    city:{
                        required: true
                    },
                    phone_no:{
                        phone : true
                    },
                    mobile_no:{
                        required: true,
                        mobile:true
                    }
                },
                messages: {
                    email:{
                        remote:"Email address already has been taken"
                    }
                }
            });
        });
    </script>
@endsection
@endsection
