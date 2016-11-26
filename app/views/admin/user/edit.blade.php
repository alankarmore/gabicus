@extends('admin.layouts.master')
@section('title', 'Update menu information')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Update menu information</h3>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            @include('admin.layouts.error')
                            <br />
                            <form role="form" name="frmUser" id='frmUser' action="{{route('admin.user.update',array('id' => $user->id))}}" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>User Type</label>
                                    <select name="user_type" id="user_type" class="form-control">
                                        <option value="student" @if($user->user_type == 'student') selected = "selected" @endif>Student</option>
                                        <option value="recruiter"  @if($user->user_type == 'recruiter') selected = "selected" @endif>Recruiter</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" placeholder="First Name" name="first_name" id="first_name" value="{{$user->first_name}}">
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" placeholder="Last Name" name="last_name" id="last_name" value="{{$user->last_name}}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" placeholder="Email" name="email" id="email" value="{{$user->email}}">
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <a href="{{route('admin.user.list')}}" class="btn btn-default">Cancel</a>
                                    <button name="reset" type="reset" class="btn btn-info">Reset</button>
                                    <button name="submit" type="submit" class="btn btn-success">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->
@section('page-script')
    <script>
        $(function(){
           $("#first_name").focus();
            activeParentMenu('users');
        });
    </script>
@endsection
@endsection