@extends('layouts.main')
@section('title', "$metaTitle")@endsection
@section('page-css')
    <link href="{{asset('assets/css/forum.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <!--------------------- Main Content ------------------->
    <div class="container">
        {{--        <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="toplinks">
                        <p>You are here :</p>
                        <ul>
                            <li class="first"><a href="{{route('/')}}">Home</a></li>
                            <li >Forum List</li>
                        </ul>
                    </div>
                </div>--}}
        <div class="col-md-12 col-sm-12 col-xs-12 margin-bottom20 nopadding-right margin-top20">
            <div class="col-md-9 nopadding-right">
                <div class="categories-details">
                    @if($jobs->count())
                    @foreach($jobs as $index => $job)
                        <div class="col-md-12 category-list margin-bottom10 @if($index > 1 && $index%2 != 0 || $index == 1) list-alternate @endif padding-bottom10">
                            <a href="{{route('jobs.view',array('id'=>$job->job->id))}}">
                                <h4 class="list-heading">{{substr($job->job->title,0,80)}}...</h4>
                            </a>
                            <p class="border-bottom">{{substr($job->job->description,0,246)}}...</p>
                            <span class="category-date-para"> By <strong>{{ucwords($job->job->recruiter->first_name." ".$job->job->recruiter->last_name)}}</strong> | Posted On:{{$job->job->created_at->toDayDateTimeString()}}</span>
                        </div>
                    @endforeach
                    @else
                        <div class="alert alert-warning"><a href="{{route('jobs.list')}}">Click Here</a> to apply your first job of Gabicus.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection