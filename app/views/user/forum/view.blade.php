@extends('layouts.main')
@section('title', "$metaTitle")
@section('page-css')
    <link href="{{asset('assets/css/forum.css')}}" rel="stylesheet" />
@endsection
@section('content')
{{--    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="toplinks">
            <p>You are here :</p>
            <ul>
                <li class="first"><a href="{{route('/')}}">Home</a></li>
                <li><a href="{{route('forum.list')}}">Forums</a></li>
            </ul>
        </div>
    </div>--}}
    <div class="clearfix"></div>
    @if(Session::has('success'))
        <div class="col-md-8 col-sm-8 col-xs-8">
        <div class="alert alert-success">
            <ul>
                <li>{{ Session::get('success') }}</li>
            </ul>
        </div>
        </div>
    @endif
    <div class="col-md-12 col-sm-8 col-xs-12 margin-bottom20">
        <div class="col-md-8 categories-height nopadding-left ">
            <div class="categories-details">
                <div class="col-md-12 nopadding category-list margin-bottom10">
                    <h4>{{$forum->question}}</h4>
                    <span class="category-date-para"> By <strong>{{ucwords($forum->user->first_name." ".$forum->user->last_name)}}</strong> | {{$forum->created_at->toDayDateTimeString()}} | {{$forum->answers->count()}} Answers</span>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 nopadding-left">
                    <p>{{$forum->description}}. </p>
                </div>
            </div>
         </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 col-sm-8 col-xs-12 margin-bottom10">
    <ul class="media-list forum">
        @if($forum->answers->count())
            @foreach($forum->answers as $answer)
                <!-- Forum Post -->
                <li class="media well">
                    <div class="media-body">
                        <p>{{$answer->answers}}</p>
                        <span class="category-date-para"> By <strong>{{ucwords($answer->user->first_name." ".$answer->user->last_name)}}</strong> | {{$answer->created_at->toDayDateTimeString()}}</span>
                    </div>
                </li>
                <!-- Forum Post END -->
            @endforeach
        @endif
    </ul>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-12 col-sm-8 col-xs-12 margin-bottom20">
        @if(!Auth::guest())
            <div class="row">
                <div class="col-md-12 col-sm-8 col-xs-12 margin-top15">
                    <div>
                        <div class="login_wrapper">
                            <div id="" class="form">
                                <section class="login_content">
                                    <form action="{{route('forum.comment',array('id'=>Route::current()->getParameter('id')))}}" method="POST" role="form">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <div class="col-md-12 margin-bottom10">
                                            <textarea class="form-control contact-textarea" placeholder="Answer *" name="answers" id="answers"></textarea>
                                            @if($errors->first('answers'))<p class="error"> {{$errors->first('answers')}} </p> @endif
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-success text-uppercase" value="POST"/>
                                                <a href="{{ URL::previous() }}" ><input type="button" class="btn btn-default text-uppercase" value="Cancel"></a>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
           <div class="alert alert-warning">You need to be <a href="{{route('user.signin')}}">Login </a> or <a href="{{route('user.signup')}}">Sign Up</a> to post a answer</div>
        @endif
    </div>
    <div class="clearfix"></div>
@endsection