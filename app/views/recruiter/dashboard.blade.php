@extends('layouts.main')
@section('content')
    <div>
        <div class="login_wrapper">
            <div>Welcome {{Auth::user()->first_name}}</div>
            <div>
                <img src="{{asset('assets/img/recruiter-dashboard.png')}}" />
            </div>
        </div>
    </div>
@endsection
@endsection
