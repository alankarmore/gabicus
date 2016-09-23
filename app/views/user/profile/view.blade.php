@extends('layouts.account')
@section('title', "$metaTitle")
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1" id="logout">
                <div class="page-header">
                    <h3 class="reviews">Dashboard</h3>
                </div>
                <div class="comment-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#account-settings" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Personal Details</h4></a></li>
                        @if($user->user_type=='employee')
                            <li><a href="#employee-settings" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Employee Details</h4></a></li>
                        @endif
                        @if($user->user_type=='student')
                            <li><a href="#student-settings" role="tab" data-toggle="tab"><h4 class="reviews text-capitalize">Student Details</h4></a></li>
                        @endif
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="account-settings">
                            <form action="#" method="post" class="form-horizontal" id="accountSetForm" role="form">
                                <div class="form-group">
                                    <label for="avatar" class="col-sm-2 control-label">Avatar</label>
                                    <div class="col-sm-10">
                                        <div class="custom-input-file">
                                            <label class="uploadPhoto">

                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Name:</label>
                                    <div class="col-md-4">
                                        <label class="col-md-10 control-label pull-left">{{ucwords($user->first_name." ".$user->last_name)}}</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Email:</label>
                                    <div class="col-md-4">
                                        <label class="col-md-10 control-label pull-left">{{$user->email}}</label>
                                    </div>
                                </div>
                                @if($user->gender!=NULL)
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Gender:</label>
                                        <div class="col-md-4">
                                            <label class="col-md-10 control-label pull-left">{{$user->gender}}</label>
                                        </div>
                                    </div>
                                @endif
                                @if($user->birth_date!=NULL)
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Birthdate:</label>
                                        <div class="col-md-4">
                                            <label class="col-md-10 control-label pull-left">{{$user->birth_date}}</label>
                                        </div>
                                    </div>
                                @endif
                                @if($user->state!=NULL)
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">State:</label>
                                        <div class="col-md-4">
                                            <label class="col-md-10 control-label pull-left">{{$user->state}}</label>
                                        </div>
                                    </div>
                                @endif
                                @if($user->phone_no!=NULL)
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Phone No:</label>
                                        <div class="col-md-4">
                                            <label class="col-md-10 control-label pull-left">{{$user->phone_no}}</label>
                                        </div>
                                    </div>
                                @endif
                                @if($user->mobile_no!=NULL)
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Mobile No:</label>
                                        <div class="col-md-4">
                                            <label class="col-md-10 control-label pull-left">{{$user->mobile_no}}</label>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <a href="{{route('user.profile.edit')}}" ><input type="button" class="btn btn-primary btn-circle text-uppercase" value="Edit"></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if($user->user_type=='employee')
                        <div class="tab-pane" id="employee-settings">
                            <form action="#" class="form-horizontal">
                                @if($user->employee->company_name!=NULL)
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Company Name:</label>
                                        <div class="col-md-4">
                                            <label class="col-md-10 control-label pull-left">{{$user->employee->company_name}}</label>
                                        </div>
                                    </div>
                                @endif
                                @if($user->designation!=NULL)
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Designation:</label>
                                        <div class="col-md-4">
                                            <label class="col-md-10 control-label pull-left">{{$user->designation}}</label>
                                        </div>
                                    </div>
                                @endif
                                @if($user->employee->specialization!=NULL)
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Specialization:</label>
                                        <div class="col-md-4">
                                            <label class="col-md-10 control-label pull-left">{{$user->employee->specialization}}</label>
                                        </div>
                                    </div>
                                @endif
                                @if($user->employee->total_it_experience!=NULL)
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Total IT Experience:</label>
                                        <div class="col-md-4">
                                            <label class="col-md-10 control-label pull-left">{{$user->employee->total_it_experience}}</label>
                                        </div>
                                    </div>
                                @endif
                                @if($user->employee->total_experience!=NULL)
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Total Experience:</label>
                                        <div class="col-md-4">
                                            <label class="col-md-10 control-label pull-left">{{$user->employee->total_experience}}</label>
                                        </div>
                                    </div>
                                @endif
                                @if($user->employee->location!=NULL)
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Location:</label>
                                        <div class="col-md-4">
                                            <label class="col-md-10 control-label pull-left">{{$user->employee->location}}</label>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <a href="{{route('user.profile.edit')}}" ><input type="button" class="btn btn-primary btn-circle text-uppercase" value="Edit"></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endif
                        @if($user->user_type=='student')
                            <div class="tab-pane" id="student-settings">
                                <form action="#" class="form-horizontal">
                                    @if($user->student->college_name!=NULL)
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">College Name:</label>
                                            <div class="col-md-4">
                                                <label class="col-md-10 control-label pull-left">{{$user->student->college_name}}</label>
                                            </div>
                                        </div>
                                    @endif
                                    @if($user->student->education!=NULL)
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Education:</label>
                                            <div class="col-md-4">
                                                <label class="col-md-10 control-label pull-left">{{$user->student->education}}</label>
                                            </div>
                                        </div>
                                    @endif
                                    @if($user->student->year!=NULL)
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Year:</label>
                                            <div class="col-md-4">
                                                <label class="col-md-10 control-label pull-left">{{$user->student->year}}</label>
                                            </div>
                                        </div>
                                    @endif
                                    @if($user->student->location!=NULL)
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Location:</label>
                                            <div class="col-md-4">
                                                <label class="col-md-10 control-label pull-left">{{$user->student->location}}</label>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <a href="{{route('user.profile.edit')}}" ><input type="button" class="btn btn-primary btn-circle text-uppercase" value="Edit"></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection