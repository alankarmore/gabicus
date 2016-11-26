@extends('layouts.main')
@section('title', "$metaTitle")
@section('content')
    <div class="container" style="margin-top: 35px">
        @include('partials.error')
        <h1>{{$user->first_name." ".$user->last_name}}'s Profile</h1>
        <div class="col-md-4">
            <div class="col-md-6">
                <div class="media">
                    <div class="pull-left">
                        @if($user->profile_image != null)
                            <img class="profile-image" src="{{asset('uploads/user')}}/{{$user->profile_image}}">
                        @else
                            <img class="profile-image" src="{{asset('uploads/user/default.png')}}">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if($user->student)
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12 margin-bottom20 nopadding-right">
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                <div class="row">
                    <div class="col-md-6">
                        @if($user->student->college_state_id != NULL)
                            <div class="form-group">
                                <label class="col-md-2 control-label">State:</label>
                                <label class="col-md-10 control-label pull-left">{{ucwords($user->student->state->name)}}</label>
                            </div>
                            <div class="clearfix"></div>
                        @endif
                        @if($user->student->university_name != NULL)
                            <div class="form-group">
                                <label class="col-md-2 control-label">University:</label>
                                <label class="col-md-10 control-label pull-left">{{ucwords($user->student->university_name)}}</label>
                            </div>
                            <div class="clearfix"></div>
                        @endif
                        @if($user->student->education_degree_id != NULL)
                            <div class="form-group">
                                <label class="col-md-2 control-label">Degree:</label>
                                <label class="col-md-10 control-label pull-left">{{ucwords($user->student->degree->name)}}</label>
                            </div>
                            <div class="clearfix"></div>
                        @endif
                        @if($user->student->passing_month != NULL)
                            <div class="form-group">
                                <label class="col-md-2 control-label">Month:</label>
                                <label class="col-md-10 control-label pull-left">{{$user->student->passing_month}}</label>
                            </div>
                            <div class="clearfix"></div>
                        @endif
                    </div>
                    <div class="col-md-6">
                        @if($user->student->college_city_id != NULL)
                            <div class="form-group">
                                <label class="col-md-2 control-label">City:</label>
                                <label class="col-md-10 control-label pull-left">{{ucwords($user->student->city->name)}}</label>
                            </div>
                            <div class="clearfix"></div>
                        @endif
                        @if($user->student->college_name != NULL)
                            <div class="form-group">
                                <label class="col-md-2 control-label">College:</label>
                                <label class="col-md-10 control-label pull-left">{{ucwords($user->student->college_name)}}</label>
                            </div>
                            <div class="clearfix"></div>
                        @endif
                        @if($user->student->education_course_type_id != NULL)
                            <div class="form-group">
                                <label class="col-md-2 control-label">Degree:</label>
                                <label class="col-md-9 pull-left">{{ucwords($user->student->course->name)}}</label>
                            </div>
                            <div class="clearfix"></div>
                        @endif
                        @if($user->student->passing_year != NULL)
                            <div class="form-group">
                                <label class="col-md-2 control-label">Year:</label>
                                <label class="col-md-10 control-label pull-left">{{$user->student->passing_year}}</label>
                            </div>
                            <div class="clearfix"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif

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