@extends('admin.layouts.master')
@section('title', 'Enrollment Details')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="x_title">
                <h2>Enrollment Information</h2>
                <span class="pull-right"><a class="btn btn-primary" href="{{route('admin.enroll')}}">Back</a></span>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                    @if (Session::has('success_message'))
                    <div class="alert alert-success">{{ Session::get('success_message')}}</div>
                    @endif                        
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif                        
                        <br />
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Name</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$enroll->name}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Email</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$enroll->email}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Age</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$enroll->age}} Year/s</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Qualification</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$enroll->qualification}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Course</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$enroll->courseInfo->title}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Experience</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$enroll->experience}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@section('page-script')
<script>
    activeParentMenu('enorll'); 
</script>
@endsection
@endsection
