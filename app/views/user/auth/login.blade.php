@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login_wrapper">
                <div id="" class="form">
                    @include('partials.error')
                    <section class="form_content">
                        <form action="{{route('user.login')}}" method="POST" novalidate>
                            <h1>Login to Account</h1>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <button type="submit" id="submit" class="btn btn-green">Sign In</button>
                            </div>
                            <div class="clearfix"></div>
                            <br/>
                            <div class="separator">
                                <p>Not a member ?
                                    <a href="{{route('user.signup')}}" class="to_register"> Create New Account</a>
                                </p>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection