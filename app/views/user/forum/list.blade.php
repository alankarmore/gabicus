@extends('layouts.main')
@section('title', "$metaTitle")
@section('content')
    <div class="container" style="margin-top: 35px">
        <div class="page-header page-heading">
            <h1 class="pull-left">Gabicus Edutech India Technical Forum </h1>
            <div class="clearfix"></div>
        </div>
        <div class="row">
            <table id="categoryTable">
                <thead>
                    <tr>
                        <th data-field="category_name" data-sortable="true">Forum Category</th>
                        <th data-field="question" data-sortable="true">Question</th>
                        <th data-field="description" data-sortable="true">Description</th>
                        <th data-field="created_at" data-sortable="true">Posted By</th>
                    </tr>
                </thead>
            </table>        
        </div>
        <?php /*<table class="table forum table-striped">
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
                    <td class="text-center"><a href="{{$forum->forumCategory->slug}}">{{ucwords($forum->forumCategory->category_name)}}</a></td>
                    <td>
                        <h4><a href="{{route('forum.view',array('id'=>$forum->id))}}">@if(strlen($forum->question) > 80){{ substr($forum->question,0,80)}}...@else {{ $forum->question }} @endif</a>
                        <br><small>@if(strlen($forum->description) > 80){{ substr($forum->description,0,100)}}@else {{ $forum->description }} @endif</small></h4>
                    </td>
                    <td class="text-center hidden-xs hidden-sm"><a href="#">{{$forum->answers->count()}}</a></td>
                    <td class="hidden-xs hidden-sm">by <a href="javascript:void(0)">{{ucwords($forum->user->first_name." ".$forum->user->last_name)}}</a><br><small><i class="fa fa-clock-o"></i> {{$forum->created_at->toDayDateTimeString()}}</small></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="text-center">
            <?php echo $forums->links(); ?>
        </div> */ ?>
    </div>
    </div>
@section('page-script')
<link href="{{asset('admin/css/bootstrap-table.css')}}" rel="stylesheet">
<script src="{{asset('admin/js/bootstrap-table.js')}}"></script>
<script type="text/javascript">
    $(function(){
        var route = "{{route('forum.list')}}";
        generateTable('forumTable',route,'created_at','desc');
    });
</script>
@endsection
@endsection