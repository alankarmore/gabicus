@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login_wrapper">
                <div id="" class="form">
                    @include('partials.error')
                    <section class="login_content">
                        <form action="{{route('user.signup')}}" method="POST">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <h1>Create Account</h1>
                            <div class="form-group">
                                <label>User Profession:</label>
                                <select class="form-control" id="user_type" name="user_type" required="required">
                                    <option value="">Select Profession</option>
                                    <option value="student">Student</option>
                                    <option value="employee">Employee</option>
                                    <option value="recruiter">Recruiter</option>
                                    <option value="none">None of the above</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>First Name:</label>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name" required="" />
                            </div>
                            <div class="form-group">
                                <label>Last Name:</label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name" required="" />
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            <div>
                                <label>Password:</label>
                                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <br/>
                            <div>
                                <button class="btn btn-primary submit" type="submit">Submit</button>
                                <a href="/"><input type="button" class="btn btn-danger" value="Cancel"></a>
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
