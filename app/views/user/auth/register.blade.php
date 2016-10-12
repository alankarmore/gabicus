@extends('layouts.main')
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
            <form action="{{route('user.signup')}}" method="POST" novalidate="">
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

<?php /*<div class="container">
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
</div> */?>
@endsection
