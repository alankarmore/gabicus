@extends('admin.layouts.master')
@section('title', 'Resume Details')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="x_title">
                <h2>Candidate Details</h2>
                <span class="pull-right"><a class="btn btn-primary" href="{{route('admin.teachwithus')}}">Back</a></span>
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
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$teachwithus->name}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Email</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$teachwithus->email}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Qualification</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$teachwithus->qualification}}</span></div>
                            </div>                            
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Age</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$teachwithus->age}} Year/s</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Location</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{ucfirst($teachwithus->location)}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Contact Number</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$teachwithus->contact_number}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">IT Experience</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$teachwithus->itexperience}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Training Courses</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$teachwithus->training_courses}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Message</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{ucfirst(strip_tags($teachwithus->message))}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Resume</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span><a href="{{route('file.download',array('file' => $teachwithus->resume))}}">Download</a></span></div>
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
    activeParentMenu('teachwithus'); 
</script>
@endsection
@endsection
