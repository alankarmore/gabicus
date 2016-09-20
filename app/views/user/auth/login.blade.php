@extends('layouts.user.auth')
@section('content')
<div>
    <div class="login_wrapper">
        <div id="" class="form">
            @include('partials.error')
            <section class="login_content">
                <form action="{{route('user.login')}}" method="POST">
                    <h1>Login to Account</h1>
                    <div>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                        <button class="btn btn-default submit" type="submit">Submit</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Not a member ?
                            <a href="{{url('user/sign-up')}}" class="to_register"> Create Account </a>
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
@endsection