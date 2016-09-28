@extends('layouts.main')
@section('title', "$metaTitle")
@section('content')
    <div class="container" style="margin-top: 35px">
        <div class="page-header page-heading">
            <h1 class="pull-left">Gabicus Edutech India Technical Forum </h1>
            <div class="clearfix"></div>
        </div>
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
    </div>
@endsection