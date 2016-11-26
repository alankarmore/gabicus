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
                    <span class="pull-right">
                        @if($user->role->role_id == 3)
                        @if(in_array($job->id,$jobIds))
                            <button class="btn btn-default margin-top10" disabled="disabled"><i class="glyphicon glyphicon-check"></i> Applied</button>
                       @else
                            <a class="btn btn-primary margin-top10" id="applyJob" data-id="{{$job->id}}">Apply</a>
                        @endif
                        @endif
                        <a class="btn btn-default margin-top10" href="{{URL::previous() }}" data-id="{{$job->id}}">Back</a>
                    </span>
                    <h4>{{ucwords($job->title)}}</h4>
                    <div class="category-date-para"> Location: {{ucwords($job->location)}} | Qualification: {{ucwords($job->qualification)}} | Skills: {{$job->skills}}</div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 nopadding-left">
                    <p>{{$job->description}}. </p>
                </div>
                <span class="category-date-para"> By <strong>{{ucwords($job->recruiter->first_name." ".$job->recruiter->last_name)}}</strong> | Posted On: {{$job->created_at->toDayDateTimeString()}}</span>
            </div>
        </div>
    </div>
    @if($user->role->role_id == 2 && $job->appliedUser->count())
    <div class="col-md-12 col-sm-8 col-xs-12 margin-bottom20">
        <h4>Applied Students</h4>
        @foreach($job->appliedUser as $user)
            <ul style="list-style: decimal">
                <li><a href="{{route('user.profile.public',array('id' => $user->user->id))}}">{{ucwords($user->user->first_name. " ".$user->user->last_name)}}</a></li>
            </ul>

        @endforeach

    </div>
    @endif
    <div class="clearfix"></div>
@section('page-script')
    <script>
        $(function(){
            $("#applyJob").click(function(){
                var route = "{{route('job.apply')}}";
                var res = null;
                var _self = $(this);
                $.ajax({
                    url:route,
                    type:'POST',
                    data:{'id':$(this).attr('data-id')},
                    dataType:"JSON",
                    beforeSend:function(){
                        _self.attr('disabled','disabled');
                    },
                    success:function(msg){
                        res = msg;
                    },
                    complete:function(){
                        if(res.valid && res.message == 'success') {
                            _self.replaceWith('<button class="btn btn-default margin-top10" disabled="disabled"><i class="glyphicon glyphicon-check"></i> Applied</button>');
                        } else {
                            _self.removeAttr('disabled');
                        }
                    }
                });
            });
        });
    </script>
@endsection
@endsection