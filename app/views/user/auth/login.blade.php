@extends('layouts.main')
@section('content')
<div class="container userprofile">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1" id="logout">
            <div class="page-header">
                <h3 class="reviews">Login to Account</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-3">
            @include('partials.error')
            <form action="{{route('user.login')}}" method="POST" novalidate>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail3">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required="" />
                </div>
                <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword3">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                </div>
                <div>
                    <button type="submit" id="submit" class="btn btn-primary">Sign In</button>
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
        </div>

    </div>
</div>
@include('partials.feedback')
@section('page-script')
<script>
    $(function(){
        $("#email").focus();
    });
</script>
@endsection
@endsection