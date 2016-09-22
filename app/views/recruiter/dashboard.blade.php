@extends('layouts.main')
@section('content')
    <div>
        <div class="login_wrapper">
            <div style="height:500px;">Welcome {{Auth::user()->first_name}}</div>
        </div>
    </div>
@endsection
@endsection
