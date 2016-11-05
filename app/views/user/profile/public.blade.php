@extends('layouts.main')
@section('title', "$metaTitle")
@section('content')
    <div class="container" style="margin-top: 35px">
        @include('partials.error')
        <h1>{{$user->first_name." ".$user->last_name}}'s Profile</h1>
        <div class="col-md-4">
            <div class="col-md-6">
                <div class="media well">
                    <div class="pull-left user-info" href="#">
                        <img class="avatar img-circle img-thumbnail" src="{{asset('uploads/user')}}/{{$user->profile_image}}" width="500" alt="Generic placeholder image">
                        <br>
                        <small class="btn-group btn-group-xs">
                            <strong><a href=""></a></strong>
                        </small>
                    </div>
                    <div class="media-body">
                        <!-- Post Info Buttons -->
                        <div class="forum-post-panel btn-group btn-group-xs">

                            {{--<a href="#" class="btn btn-danger"><i class="fa fa-warning"></i> Report post</a>--}}
                        </div>
                        <!-- Post Info Buttons END -->
                        <!-- Post Text -->
                        <p>{{ucwords($user->first_name." ".$user->last_name)}}</p>
                        <!-- Post Text EMD -->
                    </div>
                </div>
            </div>
        </div>
        @if($forums->getTotal() > 0)
        <div class="col-md-8">
            <table class="table forum table-striped">
                <thead>
                <tr>
                    <th class="cell-stat"><i class="fa fa-tags fa-2x text-primary"></i></th>
                    <th>
                        <h3>Question</h3>
                    </th>
                    <th class="cell-stat text-center hidden-xs hidden-sm">Comments</th>
                    <th class="cell-stat-2x hidden-xs hidden-sm">Post By</th>
                </tr>
                </thead>
                <tbody>
                @foreach($forums as $forum)
                    <tr>
                        <td class="text-center">Category</td>
                        <td>
                            <h4><a href="{{route('forum.view',array('id'=>$forum->id))}}">@if(strlen($forum->question) > 80){{ substr($forum->question,0,80)}}...@else {{ $forum->question }} @endif</a>
                                <br><small>@if(strlen($forum->description) > 80){{ substr($forum->description,0,100)}}@else {{ $forum->description }} @endif</small></h4>
                            <h4><small>@if(strlen($forum->description) > 80){{ substr($forum->description,100,200)}}...@else {{ $forum->description }} @endif</small></h4>
                        </td>
                        <td class="text-center hidden-xs hidden-sm"><a href="#">{{$forum->answers->count()}}</a></td>
                        <td class="hidden-xs hidden-sm">by <a href="javascript:void(0)">{{ucwords($forum->user->first_name." ".$forum->user->last_name)}}</a><br><small><i class="fa fa-clock-o"></i> {{$forum->created_at->toDayDateTimeString()}}</small></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="text-center">
                <?php echo $forums->links(); ?>
            </div>
        </div>
        @endif
    </div>
@endsection