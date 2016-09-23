@extends('layouts.main')
@section('title', "$metaTitle")
@section('page-css')
    <link href="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row">
        @include('partials.error')
        <div class="col-md-4 col-md-offset-2">
            <div>
                <div class="login_wrapper">
                    <div id="" class="form">
                        <section class="login_content">
                            <form action="{{route('user.profile.edit')}}" method="POST" role="form">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <h1>Edit Profile</h1>
                                {{--<div class="form-group">--}}
                                    {{--<label>Profile Image:</label>--}}
                                    {{--<input type='file' id="user_image" />--}}
                                    {{--<img id="user_image_preview" src="#" alt="your image" />--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name" required="" value="{{$user->first_name}}"/>
                                </div>
                                <div class="form-group">
                                    <label>Last Name:</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" required="" value="{{$user->last_name}}"/>
                                </div>
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" class="form-control" placeholder="Email" readonly value="{{$user->email}}"/>
                                </div>
                                <div class="form-group">
                                    <label>Gender:</label>
                                    <select class="form-control" id="gender" name="gender" required="required">
                                        <option value="male" @if('male' == $user->gender) selected='selected' @endif>Male</option>
                                        <option value="female" @if('female' == $user->gender) selected='selected' @endif>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Birthdate:</label>
                                    <input name="birth_date" data-autoclose="true" id="birth_date" class="form-control" required="required" value="{{$user->birth_date}}" data-provide="datepicker" readonly="readonly" data-date-format="yyyy-mm-dd"/>
                                </div>
                                <div class="form-group">
                                    <label>State:</label>
                                    <input type="text" name="state" id="state" class="form-control" required="required" placeholder="State" value="{{$user->state}}"/>
                                </div>
                                <div class="form-group">
                                    <label>City:</label>
                                    <input type="text" name="city" id="city" class="form-control" required="required" placeholder="City" value="{{$user->city}}"/>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number:</label>
                                    <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone Number" value="{{$user->phone_no}}"/>
                                </div>
                                <div class="form-group">
                                    <label>Mobile Number:</label>
                                    <input type="text" name="mobile_no" id="mobile_no" class="form-control" required="required" placeholder="Mobile Number" value="{{$user->mobile_no}}"/>
                                </div>

                                @if($user->user_type=='student')
                                    <div class="form-group">
                                        <label>College Name:</label>
                                        <input type="text" name="college_name" id="college" class="form-control" required="required" placeholder="College name" value="{{$user->student->college_name}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Education:</label>
                                        <input type="text" name="education" id="education" class="form-control" required="required" placeholder="Education (for eg: engineering)" value="{{$user->student->education}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Year:</label>
                                        <input type="text" name="year" id="year" class="form-control" required="required" placeholder="Year (for eg: 2013)" value="{{$user->student->year}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Location:</label>
                                        <input type="text" name="location" id="location" class="form-control" required="required" placeholder="Location" value="{{$user->student->location}}"/>
                                    </div>
                                @endif
                                @if($user->user_type=='employee')
                                    <div class="form-group">
                                        <label>Company Name:</label>
                                        <input type="text" name="company_name" id="company" class="form-control" required="required" placeholder="Company Name" value="{{$user->employee->company_name}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Designation:</label>
                                        <input type="text" name="designation" id="designation" class="form-control" required="required" placeholder="designation" value="{{$user->employee->designation}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Specialization:</label>
                                        <input type="text" name="specialization" id="specialization" class="form-control" required="required" placeholder="specialization" value="{{$user->employee->specialization}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Total It Experience:</label>
                                        <input type="text" name="total_it_experience" id="total_it_experience" class="form-control" required="required" placeholder="total it experience" value="{{$user->employee->total_it_experience}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Total Experience:</label>
                                        <input type="text" name="total_experience" id="total_experience" class="form-control" required="required" placeholder="total experience" value="{{$user->employee->total_experience}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Location:</label>
                                        <input type="text" name="location" id="location" class="form-control" required="required" placeholder="Location" value="{{$user->employee->location}}"/>
                                    </div>
                                @endif
                                <div>
                                    <button class="btn btn-primary submit" type="submit">Update</button>
                                    <a href="{{ URL::previous() }}" ><input type="button" class="btn btn-danger btn-circle text-uppercase" value="Cancel"></a>
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
                                    <label>Current Password:</label>
                                    <input type="password" name="current_password" class="form-control" placeholder="Current Password" required="required"/>
                                </div>
                                <div class="form-group">
                                    <label>New Password:</label>
                                    <input type="password" name="password" class="form-control" placeholder="New Password" required="required"/>
                                </div>
                                <div class="form-group">
                                    <label>Password Confirm:</label>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required="required"/>
                                </div>
                                <div>
                                    <button class="btn btn-primary submit" type="submit">Update</button>
                                    <a href="{{ URL::previous() }}" ><input type="button" class="btn btn-danger btn-circle text-uppercase" value="Cancel"></a>
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
@section('page-script')
    <script src="{{asset('assets/plugins/datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script type="application/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#user_image_preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#user_image").change(function(){
            readURL(this);
        });
    </script>
    <script>
        $('.datepicker').datepicker();
    </script>
@endsection