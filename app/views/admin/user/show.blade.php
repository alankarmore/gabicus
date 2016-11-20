@extends('admin.layouts.master')
@section('title', 'User Description')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="x_title">
                    <h2>User Information</h2>
                    <span class="pull-right"><a class="btn btn-primary" href="{{route('admin.user.list')}}">Back</a></span>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" >User Type</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{ucfirst($user->user_type)}}</span></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12">First Name</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$user->first_name}}</span></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" >Last Name</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$user->last_name}}</span></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" >Email</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$user->email}}</span></div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" >Gender</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{ucfirst($user->gender)}}</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@section('page-script')
    <script>
        activeParentMenu('users');
    </script>
@endsection
@endsection
