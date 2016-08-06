@extends('admin.layouts.master')
@section('title', 'Alumni Details')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="x_title">
                <h2>Alumni Information</h2>
                <span class="pull-right"><a class="btn btn-primary" href="{{route('admin.alumnies')}}">Back</a></span>
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
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-title">Person Name</label>
                                <div class="col-md-12 col-sm-12 col-xs-12"><span>{{ucfirst($alumni->person_name)}}</span></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12" for="course-description">Description</label>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <span>{{$alumni->description}}</span>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group">
                                <label class="col-md-12 col-sm-12 col-xs-12" for="course-title">Person Image</label>                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <img src="{{asset('uploads/alumni')}}/{{$alumni->image_name}}" width="100px" height="100px" />
                                </div>
                            </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
@section('page-script')
<script>
    activeParentMenu('alumnies'); 
</script>
@endsection
@endsection
