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
            @if(Session::has('error'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ Session::get('error') }}</li>
                    </ul>
                </div>
            @endif
            @if(Session::has('status'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{{ Session::get('status') }}</li>
                    </ul>
                </div>
            @endif
            <section class="login_content">
                <form action="/password/forgot" method="POST">
                    <h1>Forgot Password</h1>
                    <div>
                        <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                    </div>
                    <div>
                        <button class="btn btn-default submit" type="submit">Submit</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="{{url('admin/sign-up')}}" class="to_register"> Create Account </a>
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