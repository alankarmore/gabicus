<div class="logindiv">
    <div class="container">
        <div class="float-left">
            <a href="{{route('/')}}">
                <img src="{{asset('assets/img/logo.png')}}" alt="logo">
            </a>
        </div>

        <div class="float-right">
            <a href="{{route('teach-with-us')}}" class="margin-right10">Teach With Us</a> | <a href="{{route('corporate-training')}}" class="margin-left10 margin-right10">Corporate Training</a> | <a href="{{route('events')}}" class="margin-left10 margin-right10">Events</a> | <a href="{{route('recruiter')}}" class="margin-left10 margin-right10">Recruiter</a> |<a href="{{route('forum.list')}}" class="margin-left10 margin-right10">Forums</a> |
            @if(Auth::guest())
                <a href="{{route('user.signin')}}" class="margin-left10 margin-right10"> Login</a> | <a href="{{route('user.signup')}}" class="margin-left10 margin-right10">SignUp</a>
            @else
                <div class="dropdown">
                    <a href="javascript:void(0);">{{ucfirst(Auth::user()->first_name ." ".Auth::user()->last_name)}}
                        <i class="glyphicon glyphicon-chevron-down"></i>
                    </a>
                    <div class="dropdown-content">
                        <a href="{{route('user.profile.view')}}">Profile</a>
                        <a href="{{route('user.change-password')}}">Change Password</a>
                        @if('recruiter'!== Auth::user()->user_type)
                            <a href="{{route('forum.create')}}">New Question</a>
                        @endif
                        <a href="{{route('user.logout')}}">Logout</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>