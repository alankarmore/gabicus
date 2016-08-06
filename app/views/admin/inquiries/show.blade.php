@extends('admin.layouts.master')
@section('title', 'Page Title')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="x_title">
                <h2>Inquiry Information</h2>
                <span class="pull-right"><a class="btn btn-primary" href="{{route('admin.inquiries.list')}}">Back</a></span>
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
                            <div class="col-md-12 col-sm-12 col-xs-12"><span>{{ucwords($inquiry->name)}}</span></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Subject</label>
                            <div class="col-md-12 col-sm-12 col-xs-12"><span>{{ucfirst($inquiry->subject)}}</span></div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Email</label>
                            <div class="col-md-12 col-sm-12 col-xs-12"><span>{{$inquiry->email}}</span></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-12" for="course-description">Message</label>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <span>{{$inquiry->message}}</span>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection
