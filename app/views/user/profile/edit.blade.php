@extends('layouts.main')
@section('title', "$metaTitle")
@section('content')
<div class="container">
    <div class="row">
        @include('partials.error')
        <div class="col-md-4 col-md-offset-2">
            <div>
                <div class="login_wrapper">
                    <div id="" class="form">
                        <section class="login_content">
                            <form action="{{url('user/profile/edit')}}" method="POST" role="form">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <h1>Edit Profile</h1>
                                <div class="form-group">
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name" required="" value="{{$user->first_name}}"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" required="" value="{{$user->last_name}}"/>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" readonly value="{{$user->email}}"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="gender" readonly value="{{$user->gender}}" />
                                </div>
                                <div class="form-group">
                                    <input type="date" name="birth_date" id="birth_date" class="form-control" required="required" readonly value="{{$user->birth_date}}"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="state" id="state" class="form-control" required="required" placeholder="State" value="{{$user->state}}"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="city" id="city" class="form-control" required="required" placeholder="City" value="{{$user->city}}"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone Number" value="{{$user->phone_no}}"/>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mobile_no" id="mobile_no" class="form-control" required="required" placeholder="Mobile Number" value="{{$user->mobile_no}}"/>
                                </div>

                                @if($user->user_type=='student')
                                    <div class="form-group">
                                        <input type="text" name="college_name" id="college" class="form-control" required="required" placeholder="College name" value="{{$user->student->college_name}}"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="education" id="education" class="form-control" required="required" placeholder="Education (for eg: engineering)" value="{{$user->student->education}}"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="year" id="year" class="form-control" required="required" placeholder="Year (for eg: 1st,2nd)" value="{{$user->student->year}}"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="location" id="location" class="form-control" required="required" placeholder="Location" value="{{$user->student->location}}"/>
                                    </div>
                                @endif
                                @if($user->user_type=='employee')
                                    <div class="form-group">
                                        <input type="text" name="company_name" id="company" class="form-control" required="required" placeholder="Company Name" value="{{$user->employee->company_name}}"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="designation" id="designation" class="form-control" required="required" placeholder="designation" value="{{$user->employee->designation}}"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="specialization" id="specialization" class="form-control" required="required" placeholder="specialization" value="{{$user->employee->specialization}}"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="total_it_experience" id="total_it_experience" class="form-control" required="required" placeholder="total it experience" value="{{$user->employee->total_it_experience}}"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="total_experience" id="total_experience" class="form-control" required="required" placeholder="total experience" value="{{$user->employee->total_experience}}"/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="location" id="location" class="form-control" required="required" placeholder="Location" value="{{$user->employee->location}}"/>
                                    </div>
                                @endif
                                <div>
                                    <button class="btn btn-primary submit" type="submit">Update</button>
                                </div>

                                <div class="clearfix"></div>

                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-md-offset-2">
            <div>
                <div class="login_wrapper">
                    <div id="" class="form">
                        <section class="login_content">
                            <form action="{{url('user/profile/password')}}" method="POST" role="form">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <h1>Change Password</h1>
                                <div class="form-group">
                                    <input type="password" name="current_password" class="form-control" placeholder="Current Password" required="required"/>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="New Password" required="required"/>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required="required"/>
                                </div>
                                <div>
                                    <button class="btn btn-primary submit" type="submit">Update</button>
                                </div>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection