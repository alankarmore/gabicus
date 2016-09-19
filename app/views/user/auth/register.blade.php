@extends('layouts.user.auth')
@section('content')
<div>
    <div class="login_wrapper">
        <div id="" class="form">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            <section class="login_content">
                <form action="{{url('user/sign-up')}}" method="POST">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required="" />
                    </div>
                    <div>
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required="" />
                    </div>
                    <div>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="gender" name="gender" required="required">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="date" name="birth_date" id="birth_date" class="form-control" required="required"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="state" id="state" class="form-control" required="required" placeholder="State"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="city" id="city" class="form-control" required="required" placeholder="City"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone_no" id="phone_no" class="form-control" placeholder="Phone Number"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" required="required" placeholder="Mobile Number"/>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="user_type" name="user_type" required="required">
                            <option value="">Select Profession</option>
                            <option value="student">Student</option>
                            <option value="employee">Employee</option>
                            <option value="none">None of the above</option>
                        </select>
                    </div>
                    <span id="student_section" style="display:none">
                        <div class="form-group">
                            <input type="text" name="college_name" id="college" class="form-control" required="required" placeholder="College name"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="education" id="education" class="form-control" required="required" placeholder="Education (for eg: engineering)"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="year" id="year" class="form-control" required="required" placeholder="Year (for eg: 1st,2nd)"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="student_location" id="student_location" class="form-control" required="required" placeholder="Location"/>
                        </div>
                    </span>
                    <span id="employee_section" style="display:none">
                        <div class="form-group">
                            <input type="text" name="company_name" id="company" class="form-control" required="required" placeholder="Company Name"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="designation" id="designation" class="form-control" required="required" placeholder="designation"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="specialization" id="specialization" class="form-control" required="required" placeholder="specialization"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="total_it_experience" id="total_it_experience" class="form-control" required="required" placeholder="total it experience"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="total_experience" id="total_experience" class="form-control" required="required" placeholder="total experience"/>
                        </div>
                        <div class="form-group">
                            <input type="text" name="employee_location" id="employee_location" class="form-control" required="required" placeholder="Location"/>
                        </div>
                    </span>
                    <div>
                        <button class="btn btn-default submit" type="submit">Submit</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="{{url('user/sign-in')}}" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Gabicus!</h1>
                            <p>©2016 All Rights Reserved. Gabicus! Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
@stop
@section('js')
    <script type="application/javascript">
        $('#user_type').change(function(){
            if($(this).val()=='student'){
                $('#student_section').show();
                $('#employee_section').hide();

                $('#college').attr('required', 'required');
                $('#education').attr('required', 'required');
                $('#year').attr('required', 'required');
                $('#student_location').attr('required', 'required');

                $('#company').removeAttr('required');
                $('#designation').removeAttr('required');
                $('#specialization').removeAttr('required');
                $('#total_it_experience').removeAttr('required');
                $('#total_experience').removeAttr('required');
                $('#employee_location').removeAttr('required');
            }else if($(this).val()=='employee'){
                $('#employee_section').show();
                $('#student_section').hide();

                $('#college').removeAttr('required');
                $('#education').removeAttr('required');
                $('#year').removeAttr('required');
                $('#student_location').removeAttr('required');

                $('#company').attr('required', 'required');
                $('#designation').attr('required', 'required');
                $('#specialization').attr('required', 'required');
                $('#total_it_experience').attr('required', 'required');
                $('#total_experience').attr('required', 'required');
                $('#employee_location').attr('required', 'required');

            }else{
                $('#employee_section').hide();
                $('#student_section').hide();

                $('#college').removeAttr('required');
                $('#education').removeAttr('required');
                $('#year').removeAttr('required');
                $('#student_location').removeAttr('required');

                $('#company').removeAttr('required');
                $('#designation').removeAttr('required');
                $('#specialization').removeAttr('required');
                $('#total_it_experience').removeAttr('required');
                $('#total_experience').removeAttr('required');
                $('#employee_location').removeAttr('required');
            }
        });
    </script>
@stop
