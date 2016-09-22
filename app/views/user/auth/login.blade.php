@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login_wrapper">
                <div id="" class="form">
                    @include('partials.error')
                    <section class="login_content">
                        <form action="{{route('user.login')}}" method="POST">
                            <h1>Login to Account</h1>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <button class="btn btn-default submit" type="submit">Submit</button>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Not a member ?
                                    <a href="{{route('user.signup')}}" class="to_register"> Create Account </a>
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
    </div>
</div>
@endsection