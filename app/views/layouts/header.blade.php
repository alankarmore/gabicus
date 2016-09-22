<div class="logindiv">
    <div class="container">
        <div class="float-left">  
            <a href="{{route('/')}}">
                <img src="{{asset('assets/img/logo.png')}}" alt="logo">
            </a>
        </div>
        {{--<div class="float-left"><span class="icon-ph margin-right10">&#xf095;</span> <span class="margin-right30">(020) 0800 12345</span> | <span class="icon-msg margin-left30 margin-right10">&#xf0e0;</span> <a href="#">info@xyz.com</a></div>--}}
        {{--<div class="float-right"><a href="about.html" class="margin-right10">About us</a> | <a href="#" class="margin-left10 margin-right10">Services</a> | <a href="#" class="margin-left10 margin-right10">Contact us</a> | </div>--}}
        {{--<div class="float-right"><a href="javascript:void(0);" class="margin-left10 margin-right10">Submit a query</a></div>--}}
        <div class="float-right">
            @if(Auth::guest())
                <a href="{{route('user.signin')}}" class="margin-right10"> Login</a> | <a href="{{route('user.signup')}}" class="margin-left10 margin-right10">SignUp</a>
            @else
                @if('recruiter'!==Auth::user()->user_type)
                <span class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Forum <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('forum.create')}}">Create</a></li>
                        <li><a href="{{route('forum.list')}}">List</a></li>
                    </ul>
                </span> |
                <a href="{{route('user.profile.edit')}}" class="margin-left10 margin-right10">Profile</a> |
                @endif
                <a href="{{route('user.logout')}}" class="margin-right10"> Logout</a>
            @endif
        </div>
    </div>
</div>