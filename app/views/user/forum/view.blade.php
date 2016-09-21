@extends('layouts.main')
@section('title', "$metaTitle")
@section('content')
    <div class="container">
        <h1 class="page-header"><i class="fa fa-pencil"></i> {{$forum->question}} <a class="btn btn-default" href="/forum/lists"><i class="fa fa-backward"></i> Back to topics</a></h1>
        <p class="lead">{{$forum->description}}</p>
        @include('partials.error')
        <ul class="media-list forum">
            @if($forum->answers->count())
                @foreach($forum->answers as $answer)
                    <!-- Forum Post -->
                    <li class="media well">
                        <div class="pull-left user-info" href="#">
                            <img class="avatar img-circle img-thumbnail" src="http://snipplicious.com/images/guest.png"
                                 width="50" alt="Generic placeholder image">
                            <br>
                            <small class="btn-group btn-group-xs">
                                <strong><a href="javascript:void(0)">{{ucwords($answer->user->first_name." ".$answer->user->last_name)}}</a></strong>
                                {{--<a class="btn btn-default"><i class="fa fa-thumbs-o-up"></i></a>--}}
                                {{--<a class="btn btn-default"><i class="fa fa-thumbs-o-down"></i></a>--}}
                                {{--<strong class="btn btn-success">+451</strong>--}}
                            </small>
                        </div>
                        <div class="media-body">
                            <!-- Post Info Buttons -->
                            <div class="forum-post-panel btn-group btn-group-xs">
                                <a href="javascript:void(0);" class="btn btn-default"><i class="fa fa-clock-o"></i> {{$answer->created_at->toDayDateTimeString()}}</a>
                                {{--<a href="#" class="btn btn-danger"><i class="fa fa-warning"></i> Report post</a>--}}
                            </div>
                            <!-- Post Info Buttons END -->
                            <!-- Post Text -->
                            <p>{{$answer->answers}}</p>
                            <!-- Post Text EMD -->
                        </div>
                    </li>
                    <!-- Forum Post END -->
                @endforeach
            @endif
        </ul>
        @if(!Auth::guest())
            @if(!$user->id==$forum->user_id)
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div>
                            <div class="login_wrapper">
                                <div id="" class="form">
                                    <section class="login_content">
                                        <form action="{{url('forum/comment/'.Route::current()->getParameter('id'))}}" method="POST" role="form">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <h1>Add Comment</h1>
                                            <div class="form-group">
                                                <textarea class="form-control" name="answers" rows="5" placeholder="Description" required=""></textarea>
                                            </div>
                                            <div>
                                                <button class="btn btn-primary submit" type="submit">Add</button>
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
                <div class="row">
                    <div class="col-md-8 col-md-offset-4">
                        <div>
                            <div class="login_wrapper">
                                <div class="media-body media well">
                                    <p>You can't comment on your own forum</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="row">
                <div class="col-md-8 col-md-offset-4">
                    <div>
                        <div class="login_wrapper">
                            <div class="media-body media well">
                                <p>Please <a href="/user/sign-in" >login </a>to comment on this forum</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection